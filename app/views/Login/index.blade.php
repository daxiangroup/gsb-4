@extends('Layouts.master')

@section('content')
<div class="row-fluid">
    <div class="span4">
        {{ Form::open(array('url'=>URL::route('login.login'))) }}
        {{ Form::token() }}
        <div class="form-row">
            <div class="form-label">{{ Form::label('login', 'Login') }}</div>
            <div class="form-input">{{ Form::text('login', '', array('autofocus'=>'autofocus')) }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">{{ Form::label('password', 'Password') }}</div>
            <div class="form-input">{{ Form::password('password') }}</div>
        </div>

        <div class="form-row">
            <div class="form-label"></div>
            <div class="form-input">{{ Form::checkbox('remember_me', 1, 0, array('id'=>'remember_me')).Form::label('remember_me', 'Remember Me') }}</div>
        </div>

        <div class="form-row">
            <div class="form-label"></div>
            <div class="form-input">{{ Form::submit('Login', array('class'=>'btn btn-primary')) }}</div>
        </div>
        {{ Form::close() }}
    </div>

    <div class="span4">
        {{ Form::open(array('url'=>URL::route('signup.join'))) }}
        {{ Form::token() }}
        <div class="form-row">
            <div class="form-label">{{ Form::label('signup[full_name]', 'Full Name') }}</div>
            <div class="form-input">{{ Form::text('signup[full_name]') }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">{{ Form::label('signup[email]', 'Email') }}</div>
            <div class="form-input">{{ Form::text('signup[email]') }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">{{ Form::label('signup[password]', 'Password') }}</div>
            <div class="form-input">{{ Form::password('signup[password]') }}</div>
        </div>

        <div class="form-row">
            <div class="form-label">{{ Form::label('signup[graduating_year]', 'Graduating Year') }}</div>
            <div class="form-input">{{ Form::text('signup[graduating_year]') }}</div>
        </div>

        <div class="form-row">
            <div class="form-label"></div>
            <div class="form-input">{{ Form::submit('Signup', array('class'=>'btn btn-primary')) }}</div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop