@extends('layout')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf{{-- This is a token to prevent exploits on the form, without it renders an error --}}
     <p>   
        <label>Title</label>
        <input type="text" name="title"/>
     </p>

     <p>   
        <label>Content</label>
        <input type="text" name="content"/>
     </p>
    
     <button type="submit">Create!</button>
    </form>

@endsection