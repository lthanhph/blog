<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Term;
use App\MOdels\Image;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable = [
        'title',
        'content',
        'thumbnail_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'thumbnail_id');
    }

    public function postTerm()
    {
        return $this->hasMany(PostTerm::class);
    }

    public function term()
    {
        return $this->belongsToMany(Term::class, 'post_term');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function getThumbnailAttribute()
    {
        $image = $this->image()->find($this->thumbnail_id);
        if (!empty($image)) {
            $thumbnail = $image->url;
        } else {
            $image = new Image();
            $thumbnail = $image->placeholder;
        }
        return $thumbnail;
    }

    public function getCategoriesAttribute()
    {
        return $this->term()->whereRelation('taxonomy', 'name', 'category')->get();
    }

    public function getTagsAttribute()
    {
        return $this->term()->whereRelation('taxonomy', 'name', 'tag')->get();
    }

    public function getAllCategoryTitleAttribute()
    {
        $all_category_title = null;
        $categories = $this->term()->whereRelation('taxonomy', 'name', 'category')->get();
        if ($categories->isNotEmpty()) {
            $all_category_title = $categories->map(function ($category, $index) {
                return $category->title;
            })->implode(', ');
        } 
        return $all_category_title;
    }

    // public function getAllTagNameAttribute()
    // {
    //     $all_tag_name = null;
    //     $tags = $this->term()->select('title')->whereRelation('taxonomy', 'name', 'tag')->get();
    //     if ($tags->isNotEmpty()) $all_tag_name = $tags->implode(', ');
    //     return $all_tag_name;
    // }

    public function hasThumbnail()
    {
        if (!empty($this->thumbnail_id)) {
            return true;
        }
        return false;
    }

    public function getExcerptAttribute()
    {
        return Str::limit($this->content, 200);
    }

    public function getHasCommentAttribute()
    {
        $comment = $this->comment()->get();
        if ($comment->isNotEmpty()) {
            return true;
        }
        return false;
    }

    public function getCommentNumberAttribute()
    {
        $comment = $this->comment()->where('depth', 0)->get();
        return $comment->count();
    }
}
