@extends('layouts.left40')
{{-- TODO: Ensure this view is properly localized - lang is hardcoded --}}

@section('content-left')
@include('profile.navigation')
@stop

@section('content-right')

{{ Form::open(array('method'=>'POST')) }}
{{ Form::token() }}
<div class="page-header">
    <h2>Account<br>
    <small>Change your primary account settings</small></h2>
</div>

@if (Session::get('success') === false)
<div class="alert alert-error">{{ Lang::get('profile/strings.account.save_error') }}</div>
@endif

@if (Session::get('success') === true)
<div class="alert alert-success">{{ Lang::get('profile/strings.account.save_success') }}</div>
@endif

<div class="row-fluid form-row{{ $errors->has('account_username') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('profile[username]', Lang::get('profile/strings.labels.username')) }}
    </div>
    <div class="span8">
        {{ Form::text('profile[username]', $form_values['account_username']) }}
        {{ $errors->has('profile[username]') ? $errors->first('profile[username]', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('account_email') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('profile[email]', Lang::get('profile/strings.labels.email')) }}
    </div>
    <div class="span8">
        {{ Form::text('profile[email]', $form_values['account_email']) }}
        {{ $errors->has('profile[email]') ? $errors->first('profile[email]', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('account_full_name') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('profile[full_name]', Lang::get('profile/strings.labels.full_name')) }}
    </div>
    <div class="span8">
        {{ Form::text('profile[full_name]', $form_values['account_full_name']) }}
        {{ $errors->has('profile[full_name]') ? $errors->first('profile[full_name]', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('account_graduating_year') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('profile[graduating_year]', Lang::get('profile/strings.labels.graduating_year')) }}
    </div>
    <div class="span8">
        {{ Form::text('profile[graduating_year]', $form_values['account_graduating_year']) }}
        {{ $errors->has('profile[graduating_year]') ? $errors->first('profile[graduating_year]', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('account_bio') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('profile[bio]', Lang::get('profile/strings.labels.bio')) }}
    </div>
    <div class="span8">
        {{ Form::text('profile[bio]', $form_values['account_bio']) }}
        {{ $errors->has('profile[bio]') ? $errors->first('profile[bio]', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid control-row">
    <div class="span3"></div>
    <div class="span8">{{ Form::submit('Save', array('class'=>'btn btn-primary')) }}</div>
</div>
{{ Form::close() }}

@stop