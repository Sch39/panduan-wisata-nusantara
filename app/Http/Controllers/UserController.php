<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class UserController extends Controller
{
    public function showProfile()
    {
        return Inertia::render('Dashboard/User/Profile');
    }

    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|min:4',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        // Update nama
        $user->name = $request->input('name');

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        return back()->with('flash', ['status' => 'success', 'status_code' => 202, 'message' => __('succesMessage.change_user_profile')]);
    }
}
