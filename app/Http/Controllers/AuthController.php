<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ReCaptcha;
use App\Services\DbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $db;
    public function __construct(DbService $db)
    {
        $this->db = $db;
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|regex:/^\S*$/',
            'name' => 'required|string|max:128',
            'password' => [
                'required',
                'string',
                'min:5',
                'max:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ], [
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain uppercase letters, lowercase letters, and numbers.',
        ]);

        $tableName = 'users';
        $userData = [
            'username' => strtoupper($validatedData['username']),
            'name' => strtoupper($validatedData['name']),
            'email' => strtoupper($validatedData['email']),
            'password' => Hash::make($validatedData['password']),
        ];
        $this->db->createData($tableName, $userData);

        return redirect()->route('login')->withInput()->with('swal_success', 'REGIST SUCCESS');
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

        $tableName = 'users';
        $user = $this->db->getByEmailUsername($tableName, $request->name);

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
