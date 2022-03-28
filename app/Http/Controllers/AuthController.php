<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json();
        }
    }
    public function registration()
    {
        return view('auth.register');
    }


    public function register(RegisterFormRequest $request)
    {
        $user = $this->create($request->validated());
        auth()->login($user);
        return response()->json(true);
    }


    public function create($data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return response()->json(true);
    }
}
