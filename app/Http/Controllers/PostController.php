<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BlogPost;

use App\Http\Requests\StorePost;


use Illuminate\Support\Facades\Gate;
use App\User;
use Illuminate\Support\Facades\Cache;

// [
//     'show' => 'view',
//     'create' => 'create',
//     'store' => 'create',
//     'edit' => 'update',
//     'update' => 'update',
//     'destroy' => 'delete',
// ]

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $mostCommented = Cache::remember('blog-post-commented', 60, function(){
            return BlogPost::mostCommented()->take(5)->get();
        });/*give me what is under 'blog-post-commented' key, if not already 
        on cache store it for 60 minutes, with the closure function we want to return the value to
        be stored  * */

        $mostActive = Cache::remember('users-most-active' , 60, function() {
            return User::withMostBlogPosts()->take(5)->get();
        });

        $mostActiveLastMonth = Cache::remember('users-most-active-last-month', 60, function() {
            return User::withMostBlogPostsLastMonth()->take(5)->get();
        });


        return view('posts.index', 
        ['posts' => BlogPost::latest()->withCount('comments')->with('user')/*->orderBy('created_at', 'desc')*/->get(),
        /*with('user')is fetching or passing the user() relation of all this blog posts. By passing the user() relation
        the line in index.blade: :name="$post->user->name just fetch the name from the relation passed
        without having to execute a query for each blog post as was happening before */
        'mostCommented' => $mostCommented,/*moving the query to cache outside the view() function,
         means an optimization as when view() execute it will imply
         a lesser query */
        'mostActive' => $mostActive,//Variable define above and stored as cache data
        'mostActiveLastMonth' => $mostActiveLastMonth,////Variable define above and stored as cache data
        ] );/*
        latest() is scopeLatest(BlogPost.php) method call local scope definitions are named scopeNameOfScope
        this is a rule naming local scopes. latest returns an instance de query builder to which
        we are adding other quries(withCount() and get())
        fetching all blogposts with comments_count value. The commented part inside function definition works as a local scope
        was used as demo as we will work out in this lecture as a global scope. This Query will be modified by adding
        what is defined at LatestScope*/
        
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
    public function show($id) //remember $id is another reference to the argument in the Route (URI:posts/{post}), but you may name it as you wanted.
    {
        // return view('posts.show',[
        //     'post'=> BlogPost::with(['comments'=> function ($query) {
        //         return $query->latest();
        //     }])->findorFail($id),
        //     ]);
        
        $counter = 0;//for users currently on the page

        $blogPost = Cache::remember("blog-post-{$id}", 60, function() use($id) {/*"blog-post-{$id}" is a dynamic 
        key so that it fetches the blog post selected otherwise it will fetch the same blog posts.
        use($id) we are passing variable $id to be accessed from inside the closure function**/
            return BlogPost::with('comments')->findOrFail($id);
        });

        return view('posts.show', [
            'post' => $blogPost,//we are passing $blogPost to the view above we define $blogPost
            'counter' => $counter,//for users currently on the page
        ]);
        /*return view('posts.show',['post'=> BlogPost::findOrFail($id)]);/*findorFail() 
        redirects to page 404, if do not find the record. We commented the line above as we
        will be adding a comment list to blogpost with assoc comments*/
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
        //$this->authorize('posts.create'); //this is a demo for the posts.create Policies function
        return view('posts.create');
    }

    public function store(StorePost $request)/*store() saves the values captured by the form to the DB.
    We are passing class StorePost that inherit class FormRequest methods and attributes and 
    we are creating an instance of StorePost and storing it in $request. Object instance $request stores the contents input forms on create view. */
    {  
       $validatedData = $request->validated();//our rules were moved to StorePost.php and change validate() to validated()(this function is inherited from class FormRequest). If fields are left blank and submited the page will redirect to http://laravel.test/posts/create.
       $validatedData['user_id'] = $request->user()->id;/**user() is a function that belongs to $request object and it contains the currently authenticated user and we are passing it's id attribute to user_id
       but we also must define user_id as fillable in BlogPost.php */
       $blogPost = BlogPost::create($validatedData);/*We are calling static method create() that creates and save a new model(record),
       validatedData is an array containing the validated data, 
       also we are defining the attributes(in BlogPost class) we are mass assigning(meaning not individually) in this case only the title and content attributes
       to do that it must be specified in BlogPost.php model*/

       $request->session()->flash('status', 'Blog post was created!');/*As i understand at the time object $request
       access it's method session() which access it's method flash(). 'status' is an arbitrary key for string 'Blog post was
       created'. 'status' is a session variable so anytime on session where 'status' return true 'Blog post was created!' string will be rendere(see layout view) */

       return redirect()->route('posts.show', ['post' => $blogPost->id]);
       //'post'(from URI parameter posts/{post}) references $blogPost attribute id
       /*Once saved redirects to posts.show view(using as parameter the already generated id for the new record
        and renders the new record) also when we navigate to http://laravel.test/posts shows the title
        column with the added input.
       */


    }
    
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize($post);//This simpler statement instead of Gate statement
        //if(Gate::denies('update-post', $post)){//denies access to update post if not authorized
            //abort(403, "You can't edit this blog post");
        //}

        return view('posts.edit', ['post'=>$post]);


    }

    public function update(StorePost $request, $id)//remember $id is another reference to the argument in the Route (URI:posts/{post}/edit), but you may name it as you wanted.
    {
        $post = BlogPost::findOrFail($id);/*As we are updating an existing model, this line fetch the model.
        from the DB*/

        /*code below verifies if a user (whic is sent internally to function) can 
        perform or not an action. In this case if not verified as owner of blogpost
        is redirected to error 403 */
        // if(Gate::denies('update-post', $post)){
        //     abort(403, "You can't edit this blog post");//denies access to update post if not authorized
        // }
        $this->authorize($post);//simpler statement instead of Gate statement above

        $validatedData = $request->validated();//$request is only storing in memory the data from the form.
        $post->fill($validatedData);/*fill() is used as we are filling the columns of an already existing model,
        we already set the target attributes(column) on BlogPost.php */
        $post->save();
        $request->session()->flash('status', 'Blog post was updated!');/*rendered on layout view. 'status' is a session variable so anytime 
        on session where 'status' return true 'Blog post was updated!' string will be rendered */

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function destroy(Request $request, $id)//He did not explain why he used Request instead of StorePost
    {
        $post = BlogPost::findOrFail($id);

        // if(Gate::denies('delete-post', $post)){
        //     abort(403, "You can't delete this blog post");
        // }
        $this->authorize($post);
        $post->delete();

        //BlogPost::destroy($id);This do the same as the code before

        $request->session()->flash('status', 'Blog post was deleted!');//Check comments above
        
        return redirect()->route('posts.index');//Check comments above
    }





}
