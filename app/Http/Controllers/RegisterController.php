<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'fullname' => [
                    'required',
                    'string',
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
                ],
                'weight' => [
                    'required',
                    'integer'
                ],
                'height' => [
                    'required',
                    'integer',
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

    public function checkEmail(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        // Check if email exists in the database
        $emailExists = User::where('email', $request->email)->exists();

        return response()->json([
            'is_email_exist' => $emailExists,
        ]);
    }
}
