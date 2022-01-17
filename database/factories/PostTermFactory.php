<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\Term;


class PostTermFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $categorys = Term::whereRelation('taxonomy', 'name', 'category')->get()->random(5);
        // $tags = Term::whereRelation('taxonomy', 'name', 'tag')->get()->random(10);
        // $terms = $categorys->merge($tags);
        return [
            //
            'post_id' => Post::factory(),
            'term_id' => Term::inRandomOrder()->first()->id,
        ];
    }

    public function category()
    {
        return $this->state(function() {
            return [
                'term_id' => Term::whereRelation('taxonomy', 'name', 'category')->inRandomOrder()->first()->id,
            ];
        });
    }

    public function tag()
    {
        return $this->state(function() {
            return [
                'term_id' => Term::whereRelation('taxonomy', 'name', 'tag')->inRandomOrder()->first()->id,
            ];
        });
    }

    
}
