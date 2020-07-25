
    @extends('layout')

    @section('content')
        @forelse ($posts as $post){{--we are iterating around the $posts collection similar to @foreach
            de difference is thar @forelse let us use @empty clause to display a message if the
            collection is found to be empty --}}
            <p>
                <h3>
                    <a href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a>{{--parameter key 'post' 
                    from route:list URI(posts/{post}) and $post(var from @forelse clause above)->id(parameter) --}}
                </h3>{{-- here we are echoing/accessing the model attributes
                    or the columns of the database. --}}
            </p>
        @empty{{-- @forelse let us use @empty clause to display a message if the
            collection is found to be empty --}}
                <p>No blog post yet!</p>
        @endforelse
    @endsection('content')