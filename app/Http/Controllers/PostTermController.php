<?php

namespace App\Http\Controllers;

use App\Models\PostTerm;
use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Taxonomy;
use App\Models\Post;
use App\Http\Controllers\TermController;

class PostTermController extends Controller
{
    //
    /**
     * @param string|array $titles
     * @param string       $tax_name
     */
    public static function storeByTermTitle($post_id, $titles, $tax_name)
    {
        if (empty($titles)) {
            return;
        }
        $terms = TermController::storeByTitle($titles, $tax_name);
        if ($terms) {
            foreach ($terms as $term) {
                self::store($post_id, $term->id);
            }
        }
    }

    /**
     * Store new postterm record
     * 
     * @param int $post_id
     * @param int|array $term_id
     */
    public static function store($post_id, $term_id)
    {
        if (!empty($term_id)) {
            foreach ((array) $term_id as $id) {
                PostTerm::create([
                    'post_id' => $post_id,
                    'term_id' => $id
                ]);
            }
        }
    }

    public static function update($post_id, $term_ids, $tax_name)
    {
        if (!Taxonomy::firstWhere('name', $tax_name)) {
            return;
        }
        if (empty($term_ids)) {
            return;
        }
        $new_terms = Term::whereIn('id', $term_ids)->get();
        if ($new_terms->isNotEmpty()) {
            $post = Post::find($post_id);
            $old_terms = $post->getTerm($tax_name);

            if ($old_terms->isEmpty()) {
                foreach ($new_terms as $term) {
                    PostTermController::store($post->id, $term->id);
                }
            } else {

                // remove old terms
                $need_removes = $old_terms->diff($new_terms);
                foreach ($need_removes as $term) {
                    PostTermController::delete($post->id, $term->id);
                }

                // add new
                $need_to_adds = $new_terms->diff($old_terms);
                foreach ($need_to_adds as $term) {
                    PostTermController::store($post->id, $term->id);
                }
            }
        }
    }

    public static function delete($post_id, $term_id)
    {
        PostTerm::where([
            ['post_id', $post_id],
            ['term_id', $term_id]
        ])->delete();
    }

    public static function destroy($post_id)
    {
        $post_terms = PostTerm::where('post_id', $post_id)->get();
        if ($post_terms->isNotEmpty()) {
            $post_terms->each(function ($post_term, $index) {
                $post_term->delete();
            });
        }
    }
}
