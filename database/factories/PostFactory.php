<?php

namespace Database\Factories;

use App\Models\Circle;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;

    public function definition(): array
    {
        $type = $this->faker->numberBetween(1, 2);

        return [
            'post_content' => ($type === 2)
                ? $this->faker->imageUrl()
                : $this->faker->realText(222),
            'in_heaven'=> $this->faker->boolean(),
            // I only want to test with type id of text and image
            'type' => $type,
            'user_id' => User::all()->random()->id,
            'circle_id' => Circle::all()->random()->id,
        ];
    }
}
