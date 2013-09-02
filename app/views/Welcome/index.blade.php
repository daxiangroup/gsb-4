@extends('layouts/left40')

@section('content-left')
something here
@stop

@section('page-specific-js-footer')
{{ HTML::script('js/vendors/GSB/group.js') }}
@stop

@section('content-right')
{{-- TODO: Localize this view --}}
<div class="page-header">
    <h2>Welcome to Group Study Buddy<br>
    <small>Some below tagline</small></h2>
</div>

Here's the welcome page content

@stop