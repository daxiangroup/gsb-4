@extends('layouts/left40')

@section('content-left')
@include('profile.navigation')
@stop

@section('content-right')

{{ Form::open() }}
{{ Form::token() }}
<div class="page-header">
    <h2>Password<br>
    <small>Change your password or remember your current one</small></h2>
</div>

@if (Session::get('success') === false)
<div class="alert alert-error">{{ Lang::get('profile/strings.password.save_error') }}</div>
@endif

@if (Session::get('success') === true)
<div class="alert alert-success">{{ Lang::get('profile/strings.password.save_success') }}</div>
@endif

<div class="row-fluid form-row{{ $errors->has('password_current') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('password[current]', Lang::get('profile/strings.labels.password')) }}
    </div>
    <div class="span8">
        {{ Form::password('password[current]') }}
        {{ $errors->has('password[current]') ? $errors->first('password[current]', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('password_new') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('password[new]', Lang::get('profile/strings.labels.new_password')) }}
    </div>
    <div class="span8">
        {{ Form::password('password[new]') }}
        {{ $errors->has('password[new]') ? $errors->first('password[new]', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('password_verify') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('password[verify]', Lang::get('profile/strings.labels.verify_password')) }}
    </div>
    <div class="span8">
        {{ Form::password('password[verify]') }}
        {{ $errors->has('password[verify]') ? $errors->first('password[verify]', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid control-row">
    <div class="span3"></div>
    <div class="span8">{{ Form::submit('Save', array('class'=>'btn btn-primary')) }}</div>
</div>
{{ Form::close() }}

@stop