<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use App\Models\Circle_has_user;
use Illuminate\Http\Request;

class CircleHasUserController extends Controller
{
    // get the cirles that the user belongs to
    public function getMyCircles(){
        $circles = Circle_has_user::where("user_id", auth()->user()->id)->get();
        //get the circles names and id and show them in the response
        $circles = $circles->map(function($circle){
            return [
                "id"=>$circle->circle->id,
                "name"=>$circle->circle->name
            ];
        });
        return response()->json([
            "circles"=>$circles
        ]);

    }


    // Endpoint to get all the users in a circle
    public function getUsers(Request $request){
        $circle = $request->circle;
        $users = $circle->users;
        return response()->json([
            "users"=>$users
        ]);
    }

// join current user to a specific circle by id
    public function joinCircle($id){
        $circle = Circle::findOrFail($id);

        // if the user is already in the circle, return an error
        if($circle->users()->where("user_id", auth()->user()->id)->exists()){
            return response()->json([
                "message"=>"You are already in the circle"
            ], 400);
        }

        $circle->users()->attach(auth()->user()->id);
        return response()->json([
            "message"=>"Welcome to the circle ".$circle->name
        ]);
    }

    // leave a circle
    public function leaveCircle($id){
        $circle = Circle::findOrFail($id);

        // if the user is not in the circle, return an error
        if(!$circle->users()->where("user_id", auth()->user()->id)->exists()){
            return response()->json([
                "message"=>"You are not in the circle"
            ], 400);
        }

        $circle->users()->detach(auth()->user()->id);
        return response()->json([
            "message"=>"You left the circle ".$circle->name
        ]);
    }

    // Endpoint to remove a user from a circle
    public function removeUser(Request $request){
        $circle = $request->circle;
        $user = $request->user;
        $circle->users()->detach($user);
        return response()->json([
            "message"=>"User removed from circle"
        ]);
    }


}
