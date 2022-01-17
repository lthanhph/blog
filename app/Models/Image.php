<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'image';
    protected $fillable = [
        'name',
        'url',
    ];

    public function post()
    {
        return $this->hasMany(Post::class, 'thumbnail_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'avatar_id');
    }

    public function getPlaceholderAttribute()
    {
        return asset('image/placeholder/1.png');
    }

    public function getPlaceholderAvatarAttribute()
    {
        return asset('image/placeholder/avatar.png');
    }
}
