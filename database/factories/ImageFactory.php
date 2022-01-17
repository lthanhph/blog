<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $width = $this->faker->numberBetween($min = 1500, $max = 2000);
        $height = $this->faker->numberBetween($min = 500, $max = 1000);
        return [
            //
            'name' => $this->faker->text($maxNbChars = 50),
            'url' => 'https://picsum.photos/'.$width.'/'.$height,
        ];
    }
}
