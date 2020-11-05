<?php

namespace App;
use App\Scopes\LatestScope;
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

    public static function boot()/*The static boot() method is automatically run whenever 
    a model is instantiated, so it is often an ideal place to add behavior, in this case
    we are defining the behavior that will happen when a blogpost is deleted(softdeleted)
    where it is comments are also soft deleted */
    {
        parent::boot();//calls Model class where boot() lives

        static::addGlobalScope(new LatestScope);//registering LatestScope method call


        
    }
}
