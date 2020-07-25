
    @extends('layout')

    @section('content')
        <h1>{{ $post-> title }}</h1>
        <p>{{ $post->content }}</p>

        <p>Added {{ $post->created_at->diffForHumans() }}</p>{{--As created_at is by default
        converted to a date object of the Carbon library we can use it's class methods
        this method formats dates to show the time that have passed since that post was added--}}

         

        
        @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5)  
            <strong>New!</strong> 
        @endif
    @endsection('content')