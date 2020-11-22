
    @extends('layout')

    @section('content')

    
    {{--The links for this view is http://laravel.test/posts/1 or http://laravel.test/posts/2  
    (/1 and /2 refers the primary key which is ID), as i understand it's determined by the URI in the route:list--}}
        
        <h1>{{ $post-> title }}</h1>
        <p>{{ $post->content }}</p>

        <p>Added {{ $post->created_at->diffForHumans() }}</p>{{--As created_at is by default
        converted to a date object of the Carbon library we can use it's class methods
        this method formats dates to show the time that have passed since that post was added--}}

         

        
        @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 30){{-- For more info on Carbon library go to cheat sheet --}}
            <x-badge>{{--badge is the alias for
            component.blade.php and 'primary' is another badge class from
            bootstrap --}}
                Brand new post!
            </x-badge>{{-- this is the syntax for laravel 7, instead of @badge @endbadge --}}
        @endif

        <h4>Comments</h4>
        {{-- Displaying comments for blogposts --}}
        @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}, 
        </p>
        <p class="muted-text">
            added {{ $comment->created_at->diffForHumans() }}
        </p>
        @empty
        <p>No comments yet!</p>

        @endforelse
    @endsection('content')


