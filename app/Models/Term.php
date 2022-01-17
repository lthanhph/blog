<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Post;
use App\Models\Taxonomy;


class Term extends Model
{
    use HasFactory;
    protected $table = 'term';
    protected $fillable = [
        'title',
        'description',
        'taxonomy_id',
    ];

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function postTerm()
    {
        return $this->hasMany(postTerm::class);
    }

    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_term');
    }

    /**
     * @param string $term_title
     * @param string $tax_name
     * @return boolean
     */
    public static function termExists($term_title, $tax_name)
    {
        $terms = self::join('taxonomy', 'taxonomy.id', '=', 'term.taxonomy_id')
            ->where([
                ['taxonomy.name', $tax_name],
                ['term.title', $term_title],
            ])->get();
        if ($terms->count() > 0) {
            return true;
        }
        return false;
    }
}
