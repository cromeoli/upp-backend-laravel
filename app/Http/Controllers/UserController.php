<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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


}
