<?php

/*use Illuminate\Support\Facades\Route; This appraered when the folder
was originally opened as an issue from the latest version of Inteliphence extension
once the extension was downgraded to version 1.2.3, the issue seems to be resolved */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Static method 'get'(default Route method) from the Route object correspond to the http verbs(POST, GET, PUT, PATCH, and DELETE.), GET is used to fetch data it's parameters
are first the address or URL('/') and second the closure(at this state of the project closure were removed and instead we are using HomeController@*/



Route::get('/', 'HomeController@home')->name('home');
/*->middleware('auth')*//*Route was updated (in branch controllers_basics) 
from(Route::view('/', 'home')->name('home');to Route::get('/', 'HomeController@home')->name('home');
closure were removed and instead we are using HomeController.The @home(function name at HomeController) 
Rendering and behavior of page do not change.
name('') allows the naming of our routes and employ them as references(to generate the URL) to the URLs*/


Route::get('/contact', 'HomeController@contact')->name('contact');/*Route was updated (in branch controllers_basics)
from(Route::view('/contact', 'contact')->name('contact'); to Route::get('/contact', 'HomeController@contact')->name('contact');
also closure were removed and instead we are using HomeController.The @contact(function name at HomeController) 
Rendering and behavior of page do not change.
The logic for this route was moved to HomeController.php*/

Route::get('/secret', 'HomeController@secret')->name('secret')->middleware('can:home.secret');/*can works with laravel authorization system(same as @can)
  this middleware works so that the route can only be accessed only by admin users*/


Route::resource('/posts', 'PostController');/*Due we are now using most of the functions that came with the creation of PostController
we are specifying the ones we are not using, contrary to when we use only() to specified the method we wanted to use.*/
/*As we only want to display the list of the posts and an individual blog post.
since we have all these methods and the routes are ultimately generated we can
call another method to chain on other methods on the resource method and the method name is only() and
it accepts an array.So now you can specify which of those routes you want.So you only use the suffix after the resource name.
So we only want to index and show*/

//Code below was eleminated due it's purpose was to explain the use of required and optional parameters
//Route::get('/blog-post/{id}/{welcome?}', 'HomeController@blogPost')->name('blog-post');

/*Funtion above we are employing a parameter(for URL you can use as many parameters 
as you want enclosed in curly braces and separated by slash, optional parameter use ?) for the URL, identified with curly braces.
*/

/*Route was updated (in branch controllers_basics) from(Route::get('/blog-post/{id}/{welcome?}', function ($id, $welcome = 1); to Route::get('/blog-post/{id}/{welcome?}', 'HomeController@blogPost')->name('blog-post'); 
also closure were removed and instead we are using HomeController.The @blogPost(function name at HomeController)
 Rendering and behavior of page do not change.*/
//The logic for this route was moved to HomeController.php

/*Due new actions needed ->except(['destroy']) was deleted, as now it will be part of the actions, 
route list*/

Auth::routes();/*This will register all routes we need to show all those forms we see in the previous tutorials
and handle login and registration. Run route list to see auth routes added */

