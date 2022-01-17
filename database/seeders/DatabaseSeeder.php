<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use App\Models\Term;
use App\Models\User;
use App\MOdels\Comment;
use App\Models\Taxonomy;
use App\Models\PostTerm;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('role')->insert([
            ['name' => 'admin'],
            ['name' => 'writer'],
        ]);

        User::factory()->admin()->create(['name' => 'admin']);
        User::factory()->writer()->create(['name' => 'writer']);
        User::factory()->writer()->count(10)->create();

        DB::table('taxonomy')->insert([
            ['name' => 'category'],
            ['name' => 'tag']
        ]);

        $tax = Taxonomy::where('name', 'category')->first();
        $description = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry';
        DB::table('term')->insert([
            ['title' => 'news', 'description' => $description, 'taxonomy_id' => $tax->id ],
            ['title' => 'sport', 'description' => $description, 'taxonomy_id' => $tax->id ],
            ['title' => 'lifestyle', 'description' => $description, 'taxonomy_id' => $tax->id ],
            ['title' => 'travel', 'description' => $description, 'taxonomy_id' => $tax->id ],
            ['title' => 'fashion', 'description' => $description, 'taxonomy_id' => $tax->id ],
            ['title' => 'films', 'description' => $description, 'taxonomy_id' => $tax->id ],
            ['title' => 'entertainment', 'description' => $description, 'taxonomy_id' => $tax->id ],
            ['title' => 'photography', 'description' => $description, 'taxonomy_id' => $tax->id ],
            ['title' => 'foody', 'description' => $description, 'taxonomy_id' => $tax->id ],
            ['title' => 'environment', 'description' => $description, 'taxonomy_id' => $tax->id ],
        ]);

        Term::factory()->count(30)->tag()->create();
        
        Post::factory()->has(PostTerm::factory()->category())
                        ->has(PostTerm::factory()->tag()->count(8))
                        ->hasComment(10)
                        ->count(200)->create();

        DB::table('menu')->insert([
            ['name' => 'main menu', 'position' => config('menu.position.nav')],
        ]);
    }
}
