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
/* Static method 'get'(default Route method) from the Route object correspond to the http verbs(POST, GET, PUT, PATCH, and DELETE.), it's not needed to employ a 'use' statement at the top
as i understand at the moment, it belongs to a class built-in in Laravel. GET is used to fetch data it's parameters
are first the address or URL('/') and second the closure, a function without a name, it's define here and
inmediately call,  view() is called to find a 'welcome' template and it must return some content, what this function return 
is rendered(GET) */

// Route::get('/', function () {
//     //return 123;//This line was used to test the rendering, look for Master Laravel...screenshot
//     return view('home');//At this point we create a home template
// });

Route::view('/', 'home');//This view() from object Route is a simpler syntax
//that delivers the same behavior as the function commented above. It accepts two parameters
//the first is the URL and the second is the template. Same for function below.


// Route::get('/contact', function() {
//     return view('contact');
// });

Route::view('/contact', 'contact');

/*Funtion below we are employing a parameter(for URL you can use as many parameters 
as you want enclosed in curly braces and separated by slash, optional parameter use ?)for the URL identified with curly braces.
$id is the argument passed from the URL parameter.
$pages is an associative array(that consist of a key referencing a value like a dictionary)*/

Route::get('/blog-post/{id}/{welcome?}', function($id, $welcome = 1){
    $pages = [
        1 => [
            'title' => 'from page 1',
        ],
        2 => [
            'title' => 'from page 2',
        ],
    ];
    $welcomes = [1 => 'Hello', 2 => 'Welcome to '];

    return view('blog-post',['data'=> $pages[$id], 'welcome' => $welcomes[$welcome]]);/*The first parameter for function view() is 
    the view(or template).
    (Remember we already pass the URL in get()) and in the second parameter we are passing data(default parameter)
    as an array(associative). We pass an associative array with reference name 'data' to $pages[$id],
    $id as our index for $pages array.*/
});


