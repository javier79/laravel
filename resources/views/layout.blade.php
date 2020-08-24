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
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add Blog Post</a>
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