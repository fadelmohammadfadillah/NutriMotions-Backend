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
                'name' => [
                    'required',
                    'string',
                    'min:1'
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
                ],
                'weight' => [
                    'required',
                    'numeric',
                    'min:0'
                ],
                'height' => [
                    'required',
                    'numeric',
                    'min:0'
                ],
                'gender' => [
                    'required',
                    'string'
                ],
                'birthday' => [
                    'required',
                    'date'
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
