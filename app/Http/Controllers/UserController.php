<?php

namespace App\Http\Controllers;

use App\Models\Circle;
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

        // Join the user to the circle globaL
        $circle = Circle::where("name", "global")->first();
        $circle->users()->attach($user->id);

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

    // function to verify token
    public function verifyToken(Request $request){
        $user = auth()->user();

        // if the token is valid, return the user else return not authorized with code 401
        if($user){
            return response()->json([
                "user"=>$user
            ]);
        }else{
            return response()->json([
                "message"=>"Not authorized"
            ], 401);
        }
    }

    // get user by id
    public function getUser($id) {
        $user = User::find($id);
        return response()->json([
            "user" => $user
        ]);
    }

    public function getAllUsers(Request $request){
        $users = User::all();
        return response()->json([
            "users"=>$users,
        ]);
    }

    //get all user from one circle by circle_id
    public function getUsersByCircle($id){
        $circle = Circle::find($id);
        $users = $circle->users;
        return response()->json([
            "users"=>$users
        ]);
    }

    //Endpoint to delete a user, only the auth user can delete itself
    public function deleteUser(Request $request){
        $user = auth()->user();
        $user->delete();
        return response()->json([
            "message"=>"User deleted",
        ]);
    }

    public function getUserByNickname($nickname){
        $exists = User::where('nickname', $nickname)->exists();

        return response()->json([
            $exists
        ]);

    }

    public function getUserByEmail($email) {
        $exists = User::where('email', $email)->exists();

        return response()->json([
            $exists
        ]);
    }


}
