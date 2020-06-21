{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head> --}}

{{-- This block of code(up and below(<body>tags)) is commented or eliminated due it's repeated
in all our templates(pages).So we created a layout template in order to render(and store in a single file) 
the code that is common to all our pages(templates) and only store on each template('home','/contact')
the content that is relevant(or exclusive)to each page).--}}


{{-- <body> --}}
@extends('layout'){{--This is a Laravel blade directive(starts with an @), the directive
    make posible to render on this page the code that resides on layout template(that is common
    to our pages(home/contact)--}}

{{-- When contact page displays and layout extends to it, the contents of @section('content')/@endsection
will display where(tags) @yield('content') is placed in layout template --}}
@section('content') 
<h1>Contact</h1>
<p>Hello this is contact!</p>
@endsection
{{-- </body>
</html> --}}