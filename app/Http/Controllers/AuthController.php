<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showForgotForm()
    {
        return view('forgot_password');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'name' => 'nullable|string|max:255',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            'name' => $request->name ?? $request->username,
            'role_id' => 1, // 👈 Gán role người dùng thường
        ]);

        return redirect()->route('login.form')->with('success', 'Đăng ký thành công!');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password_hash)) {
            Auth::login($user);

            if ($user->role_id == 2) {
                return redirect()->route('admin.dashboard')->with('success', 'Chào mừng Admin!');
            }

            return redirect()->route('laptops.index')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
    }


    public function handleForgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
