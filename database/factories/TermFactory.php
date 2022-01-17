<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Taxonomy;

class TermFactory extends Factory
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
            'title' => $this->faker->word,
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true)
        ];
    }

    public function category()
    {

        return $this->state(function (array $attribute) {
            return [
                'taxonomy_id' => Taxonomy::where('name', 'category' )->first()->id,
            ];
        });
    }

    public function tag()
    {

        return $this->state(function (array $attribute) {
            return [
                'taxonomy_id' => Taxonomy::where('name', 'tag' )->first()->id,
            ];
        });
    }
}
