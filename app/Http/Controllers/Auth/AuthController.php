<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JWT\Token as JWTToken;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\CheckUserRequest;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    protected $access_token;
    public function __construct()
    {
        $this->access_token = new JWTToken();
    }
    public function Login(CheckUserRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if (Auth::attempt($credentials)) {
            $token = $this->access_token->token($user->name, $user->id, $user->email);
            if ($user->remember_token === $token) {
                $cookie = cookie('token', $token, 60);
                return response()->json(['message' => 'Login successful'], 200)->cookie($cookie);
            }
        }
    }
    public function Register(AddUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        Auth::login($user);
        $token = $this->access_token->token($user->name, $user->id, $user->email);
        $user->remember_token = $token;
        $user->save();
        return response()->json(['message' => 'Register successful'], 200);
    }
    public function logout()
    {
        Auth::logout();
        $cookie = Cookie::forget('token');
        return response()->json(['message' => 'Logout successful'], 200)->withCookie($cookie);
    }
}