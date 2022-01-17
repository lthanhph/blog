<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Image;

class PostFactory extends Factory
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
            'title' => $this->faker->sentence($nbWorks = 6, $variableNbWorks = true),
            'content' => $this->faker->paragraph($nbSentences = 50, $variableNbSentences = true),
            'user_id' => User::inRandomOrder()->first()->id,
            'thumbnail_id' => Image::factory(), 
        ];
    }
}
