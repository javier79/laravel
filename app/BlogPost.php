<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    //protected $table = 'blogposts';//defining custom name adding protected $table model property.

    protected $fillable = ['title', 'content'];/*This add a level of security as it won't let any malicious
    program to write in any other column*/
}
