<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        User::createData($request);
        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ], [
            'captcha.required' => 'Captcha harus diisi.',
            'captcha.captcha' => 'Captcha yang Anda masukkan salah. Silakan coba lagi.'
        ])->validate();

        $user = User::where('email', $request->name)
            ->orWhere('username', $request->name)
            ->first();

        if ($user && Auth::attempt(['email' => $user->email, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('users.create')->with('swal_success', 'LOGIN SUCCESSFUL');
        }

        return redirect()->back()->withInput()->with('swal_error', 'LOGIN FAILED');
    }

    public function refreshCaptcha()
    {
        $length = config('captcha.default.length');
        $captcha = captcha_img($length);

        return response()->json(['captcha' => $captcha]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function profile()
    {
        return view('auth/profile');
    }
}
