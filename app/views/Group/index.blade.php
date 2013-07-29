@extends('layouts/left40')

@section('content-left')
@include('group.navigation')
@stop

@section('page-specific-js-footer')
{{ HTML::script('js/vendors/GSB/group.js') }}
@stop

@section('content-right')

<div class="page-header">
    <h2>Available Study Groups<br>
    <small>Search for Study Groups</small></h2>
</div>

<div id="ctr-groups-filter" class="container">
    @include('group.partials.index.filter')
</div>
<br />

<div id="lst-groups" class="container">
@foreach ($groups as $group)
    @include('group.partials.index.listing')
@endforeach
</div>

@stop