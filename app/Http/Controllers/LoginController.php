<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user = User::findOrFail($user->id);
            // Lakukan apa yang Anda butuhkan setelah login berhasil, misalnya, redirect ke halaman tertentu
            $token = $user->createToken('Laravel10PassportAuth')->accessToken;
            return response()->json([
                'data' => $user,
                'token' => $token,
                'message'   => 'Login berhasil',
                'response'  => 200
            ]);
        } else {
            // Jika otentikasi gagal
            return response()->json([
                'message'   => 'Email/Password salah',
                'response'  => 404
            ]);
        }

    }

}
