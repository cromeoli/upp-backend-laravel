<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use Illuminate\Http\Request;

class CircleController extends Controller
{
    // Endpoint to create a circle
    public function createCircle(Request $request){
        // If the fields are not filled, return an error with a message
        if($request->name == null || $request->description == null){
            return response()->json([
                "message"=>"Por favor rellena todos los campos: name and description"
            ], 400);
        }

        $circle = Circle::create([
            "name"=>$request->name,
            "description"=>$request->description,
            "is_private"=>$request->is_private,
            "creator_id"=>auth()->user()->id
            // Future implementation of is_private and pass
        ]);
        return response()->json([
            "circle"=>$circle
        ]);
    }

    // Endpoint to get all the circles
    public function getAllCircles(Request $request){
        $circles = Circle::all();
        return response()->json([
            "circles"=>$circles
        ]);
    }

    // Endpoint to get one specific circle by id from the route Route::get("/circle/{id}", "App\Http\Controllers\CircleController@getCircle");

    public function getCircle($id) {
        $circle = Circle::find($id);
        return response()->json([
            "circle" => $circle
        ]);
    }

    // Endpoint to modify a circle
    public function modifyCircle(Request $request, $id){
        // Check if the current auth user is the circle creator, if not, return an error

        $circle = Circle::findOrFail($id);

        if($circle == null){
            return response()->json([
                "message"=>"Circle not found"
            ], 404);
        }

        if(auth()->user()->id != (int)$circle->creator_id){
            return response()->json([
                "message"=>"You are not the creator of this circle",
                "user"=>auth()->user()->id,
                "creator"=>$request->creator_id
            ], 401);
        }

        if($request->name != null){
            $circle->name = $request->name;
        }
        if($request->description != null){
            $circle->description = $request->description;
        }
        if($request->is_private != null){
            $circle->is_private = $request->is_private;
        }
        if($request->creator_id != null){
            $circle->creator_id = $request->creator_id;
        }
        if($request->pass != null){
            $circle->pass = $request->pass;
        }

        $circle->save();
        return response()->json([
            "circle"=>$circle
        ]);
    }

    // Endpoint to delete a circle
    public function deleteCircle($id){
        // Check if the current auth user is the circle creator, if not, return an error
        $circle = Circle::find($id);

        if($circle == null){
            return response()->json([
                "message"=>"Circle not found"
            ], 404);
        }

        if(auth()->user()->id != (int)$circle->creator_id){
            return response()->json([
                "message"=>"You are not the creator of this circle",
                "user"=>auth()->user()->id,
                "creator"=>$circle->creator_id
            ], 401);
        }

        $circle->delete();
        return response()->json([
            "message"=>"Circle deleted"
        ]);
    }


}
