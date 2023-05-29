<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\LoginResponse;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController
{
    public function __invoke(Request $request, LoginResponse $loginResponse)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Authenticate Users
            if ($user->role === 'admin') {

                // Check if the admin user needs to change the password
                if (Hash::check($credentials['password'], $user->password)) {
                    return redirect()->route('admin.admin-change-password');
                } else {
                    return redirect('/dashboard/admin');
                }
            
            } elseif ($user->role === 'editor') {
                return redirect('/dashboard/editor');
            } elseif ($user->role === 'designer') {
                return redirect('/dashboard/designer');
            } else {
                return redirect('/dashboard/normal');
            }

        }
        

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
}
