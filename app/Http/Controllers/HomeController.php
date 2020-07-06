<?php
namespace App\Http\Controllers;
/*Controllers class contains the logic and methods for specific Routes,
also keeps the code more organized,This tab is located on
app->http->controllers
command to crate controllers->php artisan make:controller HomeController*/
use Illuminate\Http\Request;

/*Below are the methods and logic for the behavior of each page 
it was previously in web.php, as we move it here
it looks more organized and easier to work with*/

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

    public function blogPost($id, $welcome = 1)
    {
        $pages = [
            1 => [
                'title' => 'from page 1',
            ],
            2 => [
                'title' => 'from page 2',
            ],
        ];
        $welcomes = [1 => 'Hello', 2 => 'Welcome to '];
    
        return view('blog-post',['data'=> $pages[$id], 'welcome' => $welcomes[$welcome],]);
       
    }
}

