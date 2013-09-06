@extends('Layouts/left40')

@section('content-left')
@include('Group.navigation')
@stop

@section('content-right')

<div class="page-header">
    <h2>My Study Groups<br>
    <small>You are a part of the following Study Groups</small></h2>
</div>

<div id="lst-my-groups" class="container">
@foreach ($groups as $group)
    @include('Group.partials.my_groups.listing')
@endforeach
</div>

@if (count($groups))
    @include('Group.partials.my_groups.part-modal')
@endif

@stop