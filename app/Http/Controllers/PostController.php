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
    public function show($id)//Request instance $request is pass when we are doing a reflash();
    {
        //$request->session()->reflash();// this keep the message after one more Request
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

    public function create()//This function renders a form
    {
        return view('posts.create');
    }

    public function store(Request $request)/*store() saves the values captured by the form to the DB.
    We are passing an argument of object type Request and it's instance
    is stored in variable $request*/
    {
        $validatedData = $request->validate([//we are assigning the result of function validate to $validatedData. validate() belongs to object $request instance.
            'title' => 'bail|min:5|required|max:100',//'title' refers to input type textbox on http://laravel.test/posts/create and not the column in DB, here is established the the field is required and limited to 100 characters.
            //if we add bail whenever the first rule fails, it won't proceed to validate the others.
            'content' => 'required|min:10'//same as above.
        ]);//Now with this rule if fields are left blank and submited the page will redirect to http://laravel.test/posts/create.

       $blogPost = new BlogPost();//Creating a new model(record)
       $blogPost->title = $request->input('title');//$request reads form input then $blogPost access it's attribute title column and store form input(data) in memory.
       $blogPost->content = $request->input('content');//$request reads form input then $blogPost access it's attribute title column and store form input(data) in memory.
       $blogPost->save();//what was in memory is stored on DB(written to disk) columns, also generates an id for the new record.

       $request->session()->flash('status', 'Blog post was created!');/*As i understand at the time object $request
       access it's method session() which access it's method flash(). 'status' is an arbitrary key for string 'Blog post was
       created'. */

       return redirect()->route('posts.show', ['post' => $blogPost->id]);
       //'post'(from URI parameter posts/{post}) references $blogPost attribute id
       /*Once saved redirects to posts.show view(using as parameter the already generated id for the new record
        and renders the new record) also when we navigate to http://laravel.test/posts shows the title
        column with the added input.
       */


    }





}
