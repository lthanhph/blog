<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Image;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comment";
    protected $fillable = [
        'name',
        'email',
        'content',
        'approved',
        'depth',
        'parent',
        'user_id',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDepthClassAttribute()
    {
        return config('comment.depth.'.$this->depth);
    }

    public function getHasChildrenAttribute()
    {

        $child = $this->where('parent', $this->id)->get();
        if ($child->isNotEmpty()) {
            return true;
        }
        return false;
    }

    public function getChildrenAttribute()
    {
        $children = $this->where('parent', $this->id)->get();
        return $children;
    }

    public function getAvatarAttribute()
    {
        $user = $this->user()->first();
        if ($user) {
            $avatar = $user->avatar;
        } else {
            $image = new Image();
            $avatar = $image->placeholder_avatar;
        }
        return $avatar;
    }

    public function getParentNameAttribute()
    {
        $parent = $this->find($this->parent);
        if (!empty($parent)) {
            return $parent->name;
        } 
        return null;
    }
}
