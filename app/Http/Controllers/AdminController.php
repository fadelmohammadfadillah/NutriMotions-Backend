<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return response()->json([
            'data' => $admin,
            'response' => 200
        ]);
    }

    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'min:3'
                ],
                'email' => [
                    'required',
                    'unique:admins',
                    'email',
                ],
                'password' => [
                    'required',
                    Password::min(8)
                    ->letters()
                    ->numbers()
                ]
            ]);
        }catch (ValidationException $e){
            return response()->json([
                'message' => 'Validasi data registrasi gagal',
                'errors' => $e->errors(),
                'response' => 422
            ], 422);
        }

        // hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        $admin = Admin::create($validatedData);
        $token = $admin->createToken('Laravel10PassportAuth')->accessToken;
        return response()->json([
            'admin' => $admin,
            'token' => $token,
            'message' => 'Registrasi akun admin berhasil',
            'response' => 200
        ]);

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin-api')->attempt($credentials)) {
            $admin = Auth::guard('admin-api')->user();
            $admin = Admin::findOrFail($admin->id);
            return response()->json([
                'data' => $admin,
                'message'   => 'Login berhasil',
                'response'  => 200
            ]);
        } else {
            // Jika otentikasi gagal
            return response()->json([
                'message'   => 'Email/Password salah',
                'data'      => $request->all(),
                'response'  => 404
            ], 404);
        }

    }

}
