@extends('layout')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf{{-- This is a token to prevent exploits on the form, without it renders an error --}}
     
         @include('posts._form')
    
     <button type="submit" class="btn btn-primary btn-block">Create!</button>{{--class="btn btn-primary" button color and appearance, 
     class="btn block" makes button large  --}}
    </form>

@endsection


