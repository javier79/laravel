<?php
namespace App\Http\Controllers;
/*Controllers class contains the logic and methods for specific Routes,
also keeps the code more organized,This tab is located on
app->http->controllers
command to crate controllers->php artisan make:controller HomeController*/

/*Below are the methods and logic for the behavior of each route 
it was previously in web.php, as we move it here
it looks more organized and easier to work with*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function home()
    {
        /*dd(Auth::check());/*fetch the id() of currently athenticated user. Is rendered on laravel.test
        user() fetch the model or record. check()returns true or false(for authentication)*/
        //dd(Auth::id());
       // dd(Auth::user());
        return view('home');
    }

    public function contact()
    {
       return view('contact');
    }

    public function secret()
    {
        return view('secret');
    }


}

