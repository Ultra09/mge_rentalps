<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan username, email, atau phone
        $user = DB::table('users')
            ->where('username', $request->identity)
            ->orWhere('email', $request->identity)
            ->orWhere('phone', $request->identity)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username/email/phone atau password salah!'
            ], 401);
        }

        // Buat token baru
        $token = app('auth')->login((array)$user);

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil!',
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:6',
        ]);
    
        $user = DB::table('users')->insert([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role saat daftar
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Registrasi berhasil!',
        ]);
    }
}
