<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='posts';
    use HasFactory;

    protected $fillable = [
        'content',
        'type',
        'title',
        'in_heaven',
        'circle_id',
        'user_id'
    ];

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function upp(){
        return $this->hasMany(Upp::class);
    }
}
