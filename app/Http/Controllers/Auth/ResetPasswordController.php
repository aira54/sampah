<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    /**
     * Show the form for resetting the password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        // Periksa apakah $request->email merupakan string, jika tidak, set sebagai null
        $email = is_string($request->email) ? $request->email : null;
    
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }
    

    /**
     * Handle a password reset request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
{
    // Dump and die untuk mengecek input email
    // dd($request->all());

    $request->validate([
        'token' => 'required|string',
        'email' => 'required|email|string',
        'password' => 'required|string|confirmed|min:8',
    ]);

    $response = Password::broker()->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = Hash::make($password);
            $user->setRememberToken(Str::random(60));
            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $response === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($response))
        : back()->withErrors(['email' => __($response)]);
}

}
