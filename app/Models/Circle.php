<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    protected $table='circle';
    use HasFactory;
    protected $fillable = [
        'name',
        'creator_id',
        'description',
        'is_private',
        'pass'
    ];

    protected $hidden = [
        'pass',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // relacion con Circle_has_user
    public function users()
    {
        return $this->belongsToMany(User::class, 'circle_has_user', 'circle_id', 'user_id');
    }

    // relacion con circle y creator_id
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
