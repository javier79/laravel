<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BlogPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(BlogPost::all());/*loading model. Use our handy larvel function called D.D.
         and it's a shortcut for dump and die. So it will just echo the contents of 
         whatever was passed through it and die. Run http://laravel.test/posts
         to see the collection containing out two blog posts see Screenshot
         **Due the use App\BlogPost; the name space App is not needed before BlogPost***/
    }



 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(BlogPost::find($id));/*fetching a model. Run http://laravel.test/posts/1 or 
        http://laravel.test/posts/2  (/1 and /2 refers the primary key which is ID) See Screenshots
        **Due the use App\BlogPost; the name space App is not needed before BlogPost** */ 
    }






}
