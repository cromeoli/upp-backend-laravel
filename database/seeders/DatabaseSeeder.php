<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Circle;
use App\Models\Circle_has_user;
use App\Models\Post;
use App\Models\Upp;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // TypesSeeder
        $this->call(TypesSeeder::class);
        // UsersSeeder
        $this->call(userSeeder::class);

        // Hay que añadir las factorías en orden, ya que no puedo añadir posts
        // si los círculos no existen
        User::factory(10)->create();
        Circle::factory(10)->create();
        Post::factory(10)->create();
        Upp::factory(10)->create();
        Circle_has_user::factory(10)->create();
    }
}
