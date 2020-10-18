<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//added for soft deletes of comments

class Comment extends Model
{
    use SoftDeletes;//added for soft deletes of comments

    /*remember we named it blogPost because when Laravel searches for foreign key
    converts blogPost to snake case blog_post and adds an underscore and an id
    so it will end as blog_post_id, this is how we named the column  containig the
    foreign key as defined in create_comment_table migration. if you want laravel to look for
    another name other than the default name you can specified it in the function second parameter
    belongsTo('App\BlogPost', 'post_id')*/
    public function blogPost()
    {
        return $this->belongsTo('App\BlogPost');
    }
}
