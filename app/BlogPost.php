<?php

namespace App;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    //protected $table = 'blogposts';//defining custom name adding protected $table model property.

    use SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id'];/*This add a level of security as it won't let any malicious
    program to write in any other column*/

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function boot()/*The static boot() method is automatically run whenever 
    a model is instantiated, so it is often an ideal place to add behavior, in this case
    we are defining the behavior that will happen when a blogpost is deleted(softdeleted)
    where it is comments are also soft deleted */
    {
        parent::boot();//calls Model class where boot() lives

        static::addGlobalScope(new LatestScope);//registering LatestScope method call

        static::deleting(function(BlogPost $blogPost){
            /*dd('I was deleted');/*With this statement we are testing that the callback for deleting()
            is being executed before the deletion when this execute the deletion
            does not occur as it is stopped before it execute*/

         $blogPost->comments()->delete();//deletes all the comments for each blogpost that we delete      
        });
        /*ABOVE CODE AND COMMENTS(USED ON BRANCH DELETING RELATED MODEL USING MODEL EVENTS) WERE COMMENTED WHEN IMPLEMENTED CASCADE DELETE ON
        AddCascadeDeleteToCommentsTable*/

        /*CODE ABOVE UNCOMMENTED FOR BRANCH RESTORING SOFT DELETED MODEL, MAKING COMMENTS TABLE
        TO SOFT DELETE, AS SOFT DELETION WAS SET(in DB BY MIGRATION/Comments.php) THE CODE
        ABOVE WON'T PERMANENTLY DELETE THE COMMENTS(only SOFT DELETES)*/

        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
    }
}
