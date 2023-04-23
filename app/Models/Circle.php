<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    protected $table='circles';
    use HasFactory;
    protected $fillable = [
        'name',
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
}
