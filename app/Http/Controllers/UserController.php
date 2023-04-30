<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $user = User::create([
            "nickname"=>$request->nickname,
            "description"=>$request->description,
            "email"=>$request->email,
            "password"=>bcrypt($request->password),
            "avatar"=>$request->avatar,
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            "user"=>$user,
            "token"=>$token
        ]);

    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message'=>'Invalid login details'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            "user"=>$user,
            "token"=>$token
        ]);
    }

    public function logout(Request $request): array
    {
        auth()->user()->tokens()->delete();
        return [
            'message'=>'Logged out'
        ];
    }


}
