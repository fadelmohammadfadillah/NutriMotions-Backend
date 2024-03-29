<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'username' => [
                    'required',
                    'string',
                    'unique:users',
                    'min:3'
                ],
                'email' => [
                    'required',
                    'email',
                    'unique:users'
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
            ]);
        }

        // hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);
        return response()->json([
            'user' => $user,
            'message' => 'Registrasi berhasil',
            'response' => 200
        ]);

    }
}
