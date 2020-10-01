@extends('layout')
@section('content')
<form method="POST" action="{{ route('register') }}">{{-- we are getting this route through the POST method
    to access the 'register' action(method) go to RegistersUsers.php, it expect certain fields that
    the 'register' action refers to validators and that we found defined inside validator() on 
    RegisterController.php --}}
@csrf

<div class="form-group">{{-- form-group class from bootstrap --}}
    <label>Name</label>
    <input name="name" value="{{ old('name') }}" required 
        class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}">{{-- required prevents 
    the fields from being sent without data, class="form-control"{{ $errors->has('name') ? 'is-invalid': '' }}
    If there is an error we append a style of class 'is-invalid', if no errors we don't add anything('')
    {{ old('name') }} in case the data is invalid the data  is displayed 
    for user to correct, this is not used for passwords for security and privacy concerns it might bring --}}

    @if ($errors->has('name')){{-- session variable errors --}}
        <span class="invalid-feedback">{{-- bootstrap class --}}
            <strong>{{ $errors->first('name') }}</strong>{{-- renders the first error for name field 
                errors are returned in arrays so it takes only the first error on array--}}
        </span>
    @endif
</div>

<div class="form-group">
    <label>E-mail</label>
    <input name="email" value="{{ old('email') }}" required 
      class="form-control{{ $errors->has('email') ? ' is-invalid': '' }}">

    @if ($errors->has('email')){{-- session variable errors --}}
      <span class="invalid-feedback">{{-- bootstrap class --}}
        <strong>{{ $errors->first('email') }}</strong>{{-- renders the first error for name field 
                errors are returned in arrays so it takes only the first error on array--}}
      </span>
    @endif
</div>

<div class="form-group">
  <label>Password</label>
  <input name="password" required type="password"{{-- type='password' allow password protection, meaning it will show dots instead of plain text --}}
    class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}">

  @if ($errors->has('password')){{-- session variable errors --}}
    <span class="invalid-feedback">{{-- bootstrap class --}}
      <strong>{{ $errors->first('password') }}</strong>{{-- renders the first error for name field 
                errors are returned in arrays so it takes only the first error on array--}}
    </span>
  @endif
</div>

<div class="form-group">
    <label>Retyped Password</label>
    <input name="password_confirmation" required class="form-control" type="password">
    {{--if we go to RegisterController under validator() we see that for password one of the rules
        for it is confirmed which rules that the field under validation must have a matching field of 
        foo_confirmation. For example, if the field under validation is password, a matching
        password_confirmation field must be present in the input().
        **We did not added class .is-invalid as it does not have any validation constraint
        the validation happens in the password field** --}}
</div>

<button type="submit" class="btn btn-primary btn-block">Register!</button>

</form>
@endsection('content')
{{-- url for this view laravel.test/register --}}