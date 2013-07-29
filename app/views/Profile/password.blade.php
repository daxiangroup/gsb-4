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
        {{ Form::label('password_current', Lang::get('profile/strings.labels.password')) }}
    </div>
    <div class="span8">
        {{ Form::password('password_current') }}
        {{ $errors->has('password_current') ? $errors->first('password_current', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('password_new') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('password_new', Lang::get('profile/strings.labels.new_password')) }}
    </div>
    <div class="span8">
        {{ Form::password('password_new') }}
        {{ $errors->has('password_new') ? $errors->first('password_new', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('password_verify') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('password_verify', Lang::get('profile/strings.labels.verify_password')) }}
    </div>
    <div class="span8">
        {{ Form::password('password_verify') }}
        {{ $errors->has('password_verify') ? $errors->first('password_verify', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid control-row">
    <div class="span3"></div>
    <div class="span8">{{ Form::button('Save', array('class'=>'btn btn-primary')) }}</div>
</div>
{{ Form::close() }}

@stop