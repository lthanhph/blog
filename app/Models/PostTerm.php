<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTerm extends Model
{
    use HasFactory;
    protected $table = 'post_term';
    protected $fillable = [
        'post_id',
        'term_id'
    ];

    public function post () {
        return $this->belongsTo(Post::class);
    }

    public function term () {
        return $this->belongsTo(Term::class);
    }
}
