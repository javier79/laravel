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
        /*posts.index(folder.file) is the reference to the location of the view
        The parameeter is an associative array, 'posts' is just how we name the key
        that would reference BlogPost::all()*/ 
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
        //syntax below was commented as we are using views and needed a different syntax
        /*dd(BlogPost::find($id));fetching a model. This method will show an specific elements
        of the collection defined by id. Run http://laravel.test/posts/1 or 
        http://laravel.test/posts/2  (/1 and /2 refers the primary key which is ID) See Screenshots
        **Due the use App\BlogPost; the name space App is not needed before BlogPost** */ 
    }






}
