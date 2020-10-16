<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    //protected $table = 'blogposts';//defining custom name adding protected $table model property.

    protected $fillable = ['title', 'content'];/*This add a level of security as it won't let any malicious
    program to write in any other column*/

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public static function boot()
    {
        parent::boot();//reference to Model class where boot() lives

        //static::deleting(function(BlogPost $blogPost){
            /*dd('I was deleted');/*With this statement we are testing that the callback for deleting()
            is being executed before the deletion when this execute the deletion
            does not occur as it is stopped before it execute*/

         //   $blogPost->comments()->delete();//deletes all the comments for each blogpost that we delete      
        //});
        /*ABOVE CODE AND COMMENTS(USED ON BRANCH DELETING RELATED MODEL USING MODEL EVENTS) WERE COMMENTED WHEN IMPLEMENTED CASCADE DELETE ON
        AddCascadeDeleteToCommentsTable*/
    }
}
