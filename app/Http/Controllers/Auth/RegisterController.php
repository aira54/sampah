<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'email_verified_at' => null, // Pastikan email belum terverifikasi
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => 2, // Misal role_id 2 adalah untuk user
        ]);

        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();

        // Login user
        Auth::login($user);

        // Redirect ke halaman dengan informasi
        return redirect()->route('verification.notice');
    }
}
