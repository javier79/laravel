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

Route::get('/', function () {
    //return 123;//This line was used to test the rendering, look for Master Laravel...screenshot
    return view('home');//At this point we create a home template
});

Route::get('/contact', function() {
    return view('contact');
});


