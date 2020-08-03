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
        return view('posts.index', ['posts' => BlogPost::all()]);
        /*posts.index(is the reference for posts folder and index(view))  
        The parameter is an associative array, 'posts' is an arbitrary key name 
        (referencing BlogPost::all() value in the associative array) and it's value(instance object)will be stored in the variable 
        of the same name $posts in the view index.blade.php*/ 
    }



 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show',['post'=> BlogPost::findOrFail($id)]);
         /*posts.show(is the reference for posts folder and show(view))  
        The parameter is an associative array, 'post' is an arbitrary key name 
        (referencing BlogPost::findOrFail($id) value in the associative array) and it's value(instance object)will be stored in the variable 
        of the same name $post in the view show.blade.php*/ 
        /*This function above will render view 'posts.show' when user enters URL with parameter(/1 or /2) as: http://laravel.test/posts/1 or http://laravel.test/posts/2

        //syntax below was commented as we are using views and needed a different syntax
        /*dd(BlogPost::find($id));fetching a model. This method will show an specific elements
        of the collection defined by id. This syntax was the one who showed in browser the attributes of the instances of BlogPost. See Screenshots
        **Due the use App\BlogPost; the name space App is not needed before BlogPost** */ 
    }






}
