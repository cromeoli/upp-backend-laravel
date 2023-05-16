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


    public function modifyUser(Request $request){
        $user = auth()->user();
        if($request->nickname != null){
            $user->nickname = $request->nickname;
        }
        if($request->description != null){
            $user->description = $request->description;
        }
        if($request->email != null){
            $user->email = $request->email;
        }
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }
        if($request->avatar != null){
            $user->avatar = $request->avatar;
        }
        if($request->nickname == null && $request->description == null && $request->email == null && $request->password == null && $request->avatar == null){
            return response()->json([
                "message"=>"Sin cambios",
                "success"=>false
            ]);
        }
        $user->save();
        return response()->json([
            "user"=>$user,
            "success"=>true
        ]);
    }

    public function getUser(Request $request){
        $user = User::find($request->id);
        return response()->json([
            "user"=>$user,
        ]);
    }

    public function getAllUsers(Request $request){
        $users = User::all();
        return response()->json([
            "users"=>$users,
        ]);
    }

    public function deleteUser(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return response()->json([
            "user"=>$user,
        ]);
    }

    public function searchUser(Request $request){
        $users = User::where('nickname', 'like', '%'.$request->nickname.'%')->get();
        return response()->json([
            "users"=>$users,
        ]);
    }

    public function getUserByNickname(Request $request){
        $user = User::where('nickname', $request->nickname)->first();
        return response()->json([
            "user"=>$user,
        ]);
    }

    public function getUserByEmail(Request $request){
        $user = User::where('email', $request->email)->first();
        return response()->json([
            "user"=>$user,
        ]);
    }


}
