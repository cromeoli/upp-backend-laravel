<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CircleHasUserController extends Controller
{
    // Endpoint to get all the circles a user is in
    public function getCircles(Request $request){
        $user = auth()->user();
        $circles = $user->circles;
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

    // Endpoint to add a user to a circle
    public function addUser(Request $request){
        $circle = $request->circle;
        $user = $request->user;
        $circle->users()->attach($user);
        return response()->json([
            "message"=>"User added to circle"
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
