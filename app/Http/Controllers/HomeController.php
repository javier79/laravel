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



class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function contact()
    {
       return view('contact');
    }

    public function blogPost($id, $welcome = 1)//function not in use in the present state of the project.branch:session_flash_messages
    {
        $pages = [//$pages is an associative array(that consist of a key referencing a value like a dictionary)
            1 => [
                'title' => 'from page 1',
            ],
            2 => [
                'title' => 'from page 2',
            ],
        ];
        $welcomes = [1 => 'Hello', 2 => 'Welcome to '];
    
        return view('blog-post',['data'=> $pages[$id], 'welcome' => $welcomes[$welcome],]);
    /*The first parameter for function view() is 
    the view(or template).(Remember we already pass the URL in get()) and in the second parameter we are passing data(default parameter)
    as an array(associative). We pass an associative array with reference name 'data' to $pages[$id],
    $id as our index for $pages array.*/
       
    }   
}

