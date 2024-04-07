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
            // Jika otentikasi berhasil
            $user = Auth::user();
            // Lakukan apa yang Anda butuhkan setelah login berhasil, misalnya, redirect ke halaman tertentu
            return response()->json([
                'data' => $user,
                'message'   => 'Login berhasil',
                'response'  => 200
            ]);
        } else {
            // Jika otentikasi gagal
            return response()->json([
                'message'   => 'Email/Password salah',
                'data'      => $request->all(),
                'response'  => 404
            ]);
        }

    }

}
