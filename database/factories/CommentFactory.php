<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;


class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'content' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'depth' => 0,
            'parent' => null,
            'user_id' => User::all()->random()->id,
            'post_id' => Post::factory(),
        ];
    }
}
