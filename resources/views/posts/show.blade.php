
    @extends('layout')

    @section('content')

    
    {{--The links for this view is http://laravel.test/posts/1 or http://laravel.test/posts/2  
    (/1 and /2 refers the primary key which is ID), as i understand it's determined by the URI in the route:list--}}
        
        <h1>
            {{ $post-> title }}

            {{--@if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 30){{-- We eliminate the if and place the condition inside the component alias--}}
            <x-badge :show="now()->diffInMinutes($post->created_at) < 30">{{--badge is the alias for
                component.blade.php , this syntax i found for laravel 7 in the questions on Component aliases tutorial
                show references var $show in badge.blade.php--}}
                    Brand new post!
            </x-badge>{{-- this is the syntax for laravel 7, instead of @badge @endbadge --}}
            {{--@endif--}}
        </h1>

        <p>{{ $post->content }}</p>

         
        <x-updated :date="$post->created_at"  :name="$post->user->name">{{-- laravel 7 syntax for components --}}
        </x-updated>
        <x-updated :date="$post->updated_at">  
            Updated!{{-- we specified the $slot variable to override default Added --}}
        </x-updated>
        
        <p>Currently read by {{ $counter }} people</p> 


        <h4>Comments</h4>
        {{-- Displaying comments for blogposts --}}
        @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}, 
        </p>
        <x-updated :date="$comment->created_at">{{-- laravel 7 syntax for components --}}
        </x-updated>
        @empty
        <p>No comments yet!</p>

        @endforelse
    @endsection('content')


