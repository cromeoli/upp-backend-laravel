<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circle_has_user extends Model
{
    protected $table='circle_has_user';

    use HasFactory;

    function circle(){
        return $this->belongsTo(Circle::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }


}
