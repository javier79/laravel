@extends('layout')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf{{-- This is a token to prevent exploits on the form, without it renders an error --}}
     <p>   
        <label>Title</label>
        <input type="text" name="title" value="{{old('title')}}"/>{{-- value="old()" if the data does not pass
        the validation, when the form reloads the data is kept in the input boxes to
        faccilitate the correction of it by use  --}}
     </p>

     <p>   
        <label>Content</label>
        <input type="text" name="content" value="{{old('content')}}"/>
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
    
     <button type="submit">Create!</button>
    </form>

@endsection