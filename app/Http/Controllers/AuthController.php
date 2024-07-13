<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Simpan sesi ke database
            $user = Auth::user();
            Session::create([
                'id' => $request->session()->getId(), // Pastikan ID sesi diambil dari session
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'payload' => '', // Payload dapat diisi jika diperlukan
                'last_activity' => now()->getTimestamp()
            ]);

            // return to_route('Dashboard');
            // return to_route('Dashboard');
            if (session('url.intended') == route('Home')) {
                return redirect()->route('Dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('Home');
    }

    public function register()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole(RolesEnum::USER->value);

        Auth::login($user);

        return to_route('verification.notice');
    }

    public function showForgotPasswordForm()
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
    }
}
