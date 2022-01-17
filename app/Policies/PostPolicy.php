<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
    {
        if ($user->role->name == 'admin') {
            return true;
        }
    }

    public function viewAll(User $user)
    {
        return $user->role->name == 'admin';
    }

    // public function view(User $user, Post $post)
    // {
    //     return $user->role->name == 'writer' && $user->id == $post->user_id;
    // }

    public function create(User $user)
    {
        return $user->role->name == 'writer';
    }

    public function store(User $user)
    {
        return $user->role->name == 'writer';
    }

    public function edit(User $user, Post $post)
    {
        return $user->role->name == 'writer' && $user->id == $post->user_id;
    }

    public function update(User $user, Post $post)
    {
        return $user->role->name == 'writer' && $user->id == $post->user_id;
    }
    
    public function destroy(User $user, Post $post)
    {
        return $user->role->name == 'writer' && $user->id == $post->user_id;
    }
}
