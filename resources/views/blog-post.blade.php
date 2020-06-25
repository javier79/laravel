{{--TEMPLATE/VIEW URL(default) IS http://laravel.test/blog-post/1(default display 'Hello from page 1') or http://laravel.test/blog-post/1/1(with optional parameter /1, dispays same result as http://laravel.test/blog-post/1 ) or 
    http://laravel.test/blog-post/1/2 (with optional parameter /2(display 'Welcome to from page 1')) or 
    http://laravel.test/blog-post/2/1 (with optional parameters /2/1 display 'Hello from page 2') or
    http://laravel.test/blog-post/2/2 (with optional parameters /2/2 display 'Welcome to from page 2)--}}
@extends('layout')

@section('content')
   {{ $welcome }} {{ $data['title'] }}
    {{-- We use double curly braces for rendering in the view, in this case we initialize 
        variable $data to reference our second parameter(['data'=> $pages[$id]]) for function view().
        This sintax($data['title']) responds to the fact that the rendering will only allow to pass a string and 
        var name $data alone will reference an array( ['title' => 'Hello from page 1',]). 
        When key ['title'] is specified it is referencing the string 'Hello from page...'.
        $welcome does not carry any problems as it references an string right away.
         --}}
@endsection('content')