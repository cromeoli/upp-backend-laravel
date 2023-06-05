<?php

namespace Database\Factories;

use App\Models\Circle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Circle_has_user>
 */
class Circle_has_userFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        //Get al users and join them to the circle global
        $users = User::all();
        $circle = Circle::where("name", "global")->first();

        foreach ($users as $user) {
            $circle->users()->attach($user->id);
        }

        return [
            'circle_id' => Circle::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
