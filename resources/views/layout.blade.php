<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">{{-- reference to our css files --}}
    <title>Document</title>
</head>
<body>
    {{-- The code below was taken from the cheat sheet to replace the older one, this one have some bootstrap class, not defined here, it's from the generated files compiled with npm commands --}}
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Laravel Blog</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ route('home') }}">Home</a>
            <a class="p-2 text-dark" href="{{ route('contact') }}">Contact</a>
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a>
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add</a>

            @guest{{-- displays for unregistered user --}}
                @if (Route::has('register')){{-- if session have register, meaning there is no previous session in a cookie --}}
                    <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
                @endif{{-- displays for registered user --}}
                <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
            @else{{-- displays for logged in users --}}
                <a class="p-2 text-dark" href="{{ route('logout') }}"                    
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    >Logout</a>{{-- due  route('logout')
                method is POST we can not use a direct link, most use a form. Javas Script: if click is made
                the default behavior is halt, gets form and submit it. Observe we are calling the form below
                that have no text fields as anyway it would not be displayed 
                it simply execute the action of login out the user when the Logout link is clicked,
                it does not show anything the page redirects to home again and the previous
                link that when user was logged in displayed as logout now displays login  --}}

                <form id="logout-form" action={{ route('logout') }} method="POST"
                    style="display: none;">{{-- we are not displaying the form we only wan the POST
                        request to be made for this form--}}
                    @csrf
                </form>
            @endguest
        </nav>
    </div>

    <div class="container">{{-- This class is not defined here and use bootstrap grid system, it moves div contents nearer the center,REMEMBER @yield('content') references 
        @section('content') on the views --}}
        @if(session()->has('status')){{-- if the session have key 'status'(guess function returns: TRUE) --}}
            <p style="color:green">
                {{ session()->get('status') }}{{-- echo the string 'Blog post was created!' referenced 
        by key 'status' (see PostController.php)--}}
            </p>
        @endif

        @yield('content'){{-- This directive is the reference for the content between 
        @section('content')/@endsection (on contact and home pages(templates)) and points to the tags where
        their content will display when the layout template is extended to each page(ex:home/contact pages 
        (templates))when displayed --}}
    </div>

    <script src="{{ mix('js/app.js') }}"></script>{{-- reference to our javascript files --}}
</body>
</html>