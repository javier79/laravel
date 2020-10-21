<?php

namespace App\Policies;

use App\BlogPost;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\BlogPost  $blogPost
     * @return mixed
     */
    public function view(User $user, BlogPost $blogPost)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\BlogPost  $blogPost
     * @return mixed
     */
    public function update(User $user, BlogPost $blogPost)
    {
        //dd('Updating!');
        return $user->id == $blogPost->user_id;/*pasted and edited from Gate statements on
        AuthServiceProvider.php*/
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\BlogPost  $blogPost
     * @return mixed
     */
    public function delete(User $user, BlogPost $blogPost)
    {
        //dd('Deleting!');
        return $user->id == $blogPost->user_id;/*pasted and edited from Gate statements on
        AuthServiceProvider.php*/
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\BlogPost  $blogPost
     * @return mixed
     */
    public function restore(User $user, BlogPost $blogPost)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\BlogPost  $blogPost
     * @return mixed
     */
    public function forceDelete(User $user, BlogPost $blogPost)
    {
        //
    }
}
