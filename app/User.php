<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function blogPosts()
    {
        return $this->hasMany('App\BlogPost');//'App\BlogPost'is the same as App\BlogPost::class
    }

    public function scopeWithMostBlogPosts(Builder $query)/*function definition that fetch Users blog posts and
    sorts them in descending order*/
    {
        return $query->withCount('BlogPosts')->orderBy('blog_posts_count', 'desc');
    }

    public function scopeWithMostBlogPostsLastMonth(Builder $query)
    {
        return $query->withCount(['blogPosts' => function (Builder $query) {//first query object fetch all blog posts, query object in closure adds other queries to first one
            $query->whereBetween(static::CREATED_AT, [now()->subMonths(1), now()]);//sort created_at column from one month(from now or today) to now(today)
        }])->has('blogPosts', '>=', 2)//Users with more than 2 blog posts(that are at least a month old)This line was corrected check notebookII, and looks different than tutorial.
           ->orderBy('blog_posts_count', 'desc');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
