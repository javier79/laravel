@extends('layout')

@section('content')
    <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
        @csrf{{-- This is a token to prevent exploits on the form, without it renders an error --}}
        @method('PUT'){{-- form elements can't use methods other than GET and POST(line 4:form method="POST"), 
        so in order for laravel to treat it like an actual request with the PUT method.
        be able to edit, we use @method('PUT') called method spoofing that let us use
        PUT method that belong to posts.update see Route list --}}
     <p>   
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', $post->title)}}"/>{{-- value="old()" if the data does not pass
        the validation, when the form reloads the data is kept in the input boxes to
        faccilitate the correction of it by user. $post->title this second parameter is a default value  --}}
     </p>

     <p>   
        <label>Content</label>
        <input type="text" name="content" value="{{old('content', $post->content)}}"/>
     </p>

     @if($errors->any()){{-- Check notebook notes, $errors is a session variable(available to all views)
      this variable 'errors'live in function handle() from Middleware\ShareErrorsFromSession) --}}
      <div>
         <ul>
            @foreach($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
    
     <button type="submit">Update!</button>
    </form>

@endsection