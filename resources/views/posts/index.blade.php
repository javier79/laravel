
    @extends('layout')

    @section('content')
        @forelse ($posts as $post){{--we are iterating around the $posts collection similar to @foreach
            de difference is thar @forelse let us use @empty clause to display a message if the
            collection is found to be empty --}}
            <p>
                <h3>
                    <a href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a>
                    {{--'post.show' is the name of the route as per route:list. Parameter key 'post' 
                    from route:list URI(.../{post}) and $post(var from @forelse clause above)->id(parameter).
                    ['post'=>$post->id]('post' key references object(record)stored in $post which is accessing 
                    it's attribute id). {{ $post->title }}(render's attribute title)--}}
                </h3>{{-- here we are echoing/accessing the model attributes
                    or the columns of the database. --}}
            </p>
        @empty{{-- @forelse let us use @empty clause to display a message if the
            collection is found to be empty --}}
                <p>No blog post yet!</p>
        @endforelse
    @endsection('content')

    {{--The link for this view is laravel.test/posts, as i understand it's determined
    by the URI in the route:list--}}