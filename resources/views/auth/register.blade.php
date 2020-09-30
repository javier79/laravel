@extends('layout')
@section('content')
<form method="POST" action="{{ route('register') }}">{{-- we are getting this route through the POST method
    to access the 'register' action(method) go to RegistersUsers.php, it expect certain fields that
    the 'register' action refers to validators and that we found defined inside validator() on 
    RegisterController.php --}}
@csrf

<div class="form-group">{{-- form-group class from bootstrap --}}
    <label>Name</label>
    <input name="name" value="{{ old('name') }}" required class="form-control">{{-- required class="form-control" from
    prevents the fields from being sent without data,
    {{ old('name') }} in case the data is invalid the data is displayed 
    for user to correct, this is not used for passwords for security and privacy concerns it might bring --}}
</div>

<div class="form-group">
    <label>E-mail</label>
    <input name="email" value="{{ old('name') }}" required class="form-control">
</div>

<div class="form-group">
    <label>Password</label>
    <input name="password" required class="form-control">
</div>

<div class="form-group">
    <label>Retyped Password</label>
    <input name="password_conformation" required class="form-control">
    {{--if we go to RegisterController under validator() we see that for password one of the rules
        for it is confirmed which rules that the field under validation must have a matching field of 
        foo_confirmation. For example, if the field under validation is password, a matching
        password_confirmation field must be present in the input() --}}
</div>

<button type="submit" class="btn btn-primary btn-block">Register</button>

</form>
@endsection('content')
{{-- url for this view laravel.test/register --}}