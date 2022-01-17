<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'avatar_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    /**
     * Determine user has a role or not.
     * @param string $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if ($this->role->name == $role) {
            return true;
        }
        return false;
    }

    public function getAvatarAttribute()
    {
        $image = $this->image()->find($this->avatar_id);
        if (!empty($image)) {
            $avatar = $image->url;
        } else {
            $image = new Image();
            $avatar = $image->placeholder_avatar;
        }
        return $avatar;
    }

    public function getIsAdminAttribute()
    {
        if ($this->role->name == 'admin') {
            return true;
        }
        return false;
    }
}
