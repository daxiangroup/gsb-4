@extends('layouts/left40')

@section('content-left')
@include('group.navigation')
@stop

@section('page-specific-js-footer')
{{ HTML::script('js/vendors/GSB/group.js') }}
@stop

@section('content-right')

{{ Form::open() }}
{{ Form::token() }}
<div class="page-header">
    <h2>{{ Lang::get('Group/strings.headers.create') }}<br>
    <small>{{ Lang::get('Group/strings.subheaders.create') }}</small></h2>
</div>

<p>{{ Lang::get('Group/intros.create') }}</p>

<div class="row-fluid form-row{{ $errors->has('group_name') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('group[name]', Lang::get('Group/strings.labels.name')) }}
    </div>
    <div class="span8">
        {{ Form::text('group[name]', $form_values['group_name']) }}
        {{ $errors->has('group_name') ? $errors->first('group_name', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('group_graduating_year') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('group[graduating_year]', Lang::get('Group/strings.labels.graduating_year')) }}
    </div>
    <div class="span8">
        {{ Form::text('group[graduating_year]', $form_values['group_graduating_year']) }}
        {{ $errors->has('group_graduating_year') ? $errors->first('group_graduating_year', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row">
    <div class="span3">
        {{ Lang::get('Group/strings.labels.admin') }}
    </div>
    <div class="span8">
        {{ Form::text('group[admin]', $form_values['group_admin'], array('readOnly'=>'true')) }}
        {{ Form::hidden('group[admin_id]', $form_values['group_admin_id']) }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('group_co_admin') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('group[co_admin]', Lang::get('Group/strings.labels.co_admin')) }}
    </div>
    <div class="span8">
        {{ Form::text('group[co_admin]', $form_values['group_co_admin']) }}
        {{ $errors->has('group_co_admin') ? $errors->first('group_go_admin', Config::get('rtconfig.format.validation_message')) : '' }}
        <span class="field-explanation">{{ Lang::get('Group/strings.explanation.co_admin') }}</span>
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('group_max_size') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('group[max_size]', Lang::get('Group/strings.labels.max_size')) }}
    </div>
    <div class="span8">
        {{ Form::text('group[max_size]', $form_values['group_max_size']) }}
        {{ $errors->has('group_max_size') ? $errors->first('group_max_size', Config::get('rtconfig.format.validation_message')) : '' }}
        <span class="field-explanation">{{ Lang::get('Group/strings.explanation.max_size') }}</span>
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('group_description') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('group[description]', Lang::get('Group/strings.labels.description')) }}
    </div>
    <div class="span8">
        {{ Form::text('group[description]', $form_values['group_description']) }}
        {{ $errors->has('group_description') ? $errors->first('group_description', Config::get('rtconfig.format.validation_message')) : '' }}
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('group_headline') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('group[headline]', Lang::get('Group/strings.labels.headline')) }}
    </div>
    <div class="span8">
        {{ Form::text('group[headline]', $form_values['group_headline']) }}
        {{ $errors->has('group_headline') ? $errors->first('group_headline', Config::get('rtconfig.format.validation_message')) : '' }}
        <span class="field-explanation">{{ Lang::get('Group/strings.explanation.headline') }}</span>
    </div>
</div>

<div class="row-fluid form-row{{ $errors->has('group_visibility') ? ' error' : '' }}">
    <div class="span3">
        {{ Form::label('group[visibility]', Lang::get('Group/strings.labels.visibility')) }}
    </div>
    <div class="span8">
        {{ Form::radio('group[visibility]', $form_values['group_visibility']['open']['value'], $form_values['group_visibility']['open']['checked'], array('id'=>'group_visibility_open')) }}
        {{ Form::label('group_visibility_open', Lang::get('Group/strings.labels.visibility-open')) }}
        {{ $errors->has('group_headline') ? $errors->first('group_headline', Config::get('rtconfig.format.validation_message')) : '' }}
        <span class="field-explanation">{{ Lang::get('Group/strings.explanation.visibility-open') }}</span>
    </div>
</div>
<div class="row-fluid form-row">
    <div class="span8 offset3">
        {{ Form::radio('group[visibility]', $form_values['group_visibility']['closed']['value'], $form_values['group_visibility']['closed']['checked'], array('id'=>'group_visibility_closed')) }}
        {{ Form::label('group_visibility_closed', Lang::get('Group/strings.labels.visibility-closed')) }}
        <span class="field-explanation">{{ Lang::get('Group/strings.explanation.visibility-closed') }}</span>
    </div>
</div>
<div class="row-fluid form-row">
    <div class="span8 offset3">
        {{ Form::radio('group[visibility]', $form_values['group_visibility']['private']['value'], $form_values['group_visibility']['private']['checked'], array('id'=>'group_visibility_private')) }}
        {{ Form::label('group_visibility_private', Lang::get('Group/strings.labels.visibility-private')) }}
        <span class="field-explanation">{{ Lang::get('Group/strings.explanation.visibility-private') }}</span>
    </div>
</div>



<div class="page-header">
    <h2><small>{{ Lang::get('Group/strings.subheaders.create-meetings') }}</small></h2>
</div>

<p>{{ Lang::get('Group/intros.create-meetings') }}</p>


<div class="row-fluid control-row">
    <div class="span3"></div>
    <div class="span8">{{ Form::submit('Save', array('class'=>'btn btn-primary')) }}</div>
</div>
{{ Form::close() }}

@stop