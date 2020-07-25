<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li><a href="{{ route('posts.index') }}">Blog Post</a></li>{{-- ('posts.index')is the route name as in route:list --}}
        {{-- Code below was eliminated due it is going into a separate Controller class to clean up the code --}}
        {{-- <li><ahref="route('blog-post',['id'=>1]) ">Blog post 1</a></li>--}}{{-- As our URL use a parameter
            the parameter is passed in an associative array --}}

        {{--<li><a href="/">Home</a></li> This is a reference with a hardcoded URL
        above{{ route('home') }}syntax allows for the use of names as reference ()to generate URLs)--}}

    </ul>
    @yield('content'){{-- This directive is the reference for the content between 
        @section('content')/@endsection (on contact and home pages(templates)) and points to the tags where
        their content will display when the layout template is extended to each page(ex:home/contact pages 
        (templates))when displayed --}}
</body>
</html>