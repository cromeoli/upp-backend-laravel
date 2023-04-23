<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypesController extends Controller
{
    public function getAllTypes(){
        $types = Type::all();
        return response()->json($types);
    }
}
