<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return Inertia::render('Auth/ForgotPassword');
    }


    public function showResetPasswordForm(string $locale, string $token, Request $request)
    {
        $email = $request->query('email');

        return Inertia::render('Auth/ResetPassword', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('flash', ['status' => 'success', 'status_code' => 202, 'message' => __($status)])
            : back()->withErrors(['message' => __($status), 'status' => 'error', 'status_code' => 500]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $credentials = [
            'password' => $request->new_password,
            'email' => $request->email,
        ];

        $status = Password::reset(
            [
                ...$credentials,
                'token' => $request->token,
            ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            // if (Auth::attempt($credentials)) {
            //     return to_route('Dashboard')->with('flash', ['status' => 'success', 'status_code' => 202, 'message' => __($status)]);
            // }
            return to_route('Auth.login')->with('flash', ['status' => 'success', 'status_code' => 202, 'message' => __($status)]);
        }

        return  back()->withErrors(['email' => [__($status)]]);
    }
}
