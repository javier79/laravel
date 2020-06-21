<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @yield('content'){{-- This directive is the reference for the content between 
        @section('content')/@endsection (on contact and home pages(templates)) and points to the tags where
        their content will display when the layout template is extended to each page(ex:home/contact pages 
        (templates))when displayed --}}
</body>
</html>