@extends('layout')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf{{-- This is a token to prevent exploits on the form, without it renders an error --}}
     
         @include('posts._form')
    
     <button type="submit">Create!</button>
    </form>

@endsection


