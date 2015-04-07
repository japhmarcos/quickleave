@extends('layouts.master')

@section('title')
	Join Us! Register Now
@stop

@section('content')
	@foreach($errors->all() as $error)
		<p>{!! $error !!}</p>
	@endforeach
{!! Form::open(array('url' => 'users')) !!}
	<h1>Register</h1>


	<p>
    	{!! Form::label('firstname', 'Firstname') !!}
    	{!! Form::text('firstname', Input::old('firstname'))!!}
	</p>

	<p>
    	{!! Form::label('lastname', 'Lastname') !!}
    	{!! Form::text('lastname', Input::old('lastname'))!!}
	</p>

	<p>
    	{!! Form::label('email', 'Email') !!}
    	{!! Form::email('email', Input::old('email'))!!}
	</p>

	<p>
    	{!! Form::label('username', 'Username') !!}
    	{!! Form::text('username', Input::old('username'))!!}
	</p>

	<p>
    	{!! Form::label('password', 'Password') !!}
    	{!! Form::password('password') !!}
	</p>

	<p>
    	{!! Form::label('_conf_password', 'Confirm Password') !!}
    	{!! Form::password('conf_password') !!}
	</p>

	

	<p>{!! Form::submit() !!}</p>
{!! Form::close() !!}
@stop