@extends('layout')

@section('content')
    <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
        @csrf{{-- This is a token to prevent exploits on the form, without it renders an error --}}
        @method('PUT'){{-- form elements can't use methods other than GET and POST(line 4:form method="POST"), 
        so in order for laravel to treat it like an actual request with the PUT method.
        be able to edit, we use @method('PUT') called method spoofing that let us use
        PUT method that belong to posts.update see Route list --}}
     
        @include('posts._form'){{-- reference the view were the form input fields and validation display
            resides, that we move to a single view due it shares partially some code
            with the create form, so that way we don't duplicate code --}}
    
     <button type="submit" class="btn btn-primary btn-block">Update!</button>{{--class="btn btn-primary" button color and appearance, 
     class="btn block" makes button large  --}}
    </form>

@endsection 