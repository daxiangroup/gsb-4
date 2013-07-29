@extends('layouts/left40')

@section('content-left')
@include('group.navigation')
@stop

@section('page-specific-js-footer')
{{ HTML::script('js/vendors/GSB/group.js') }}
@stop

@section('content-right')

<div class="page-header">
    <h2>{{ $group->getName() }}<br>
</div>

Headline<br>
{{ $group->getHeadline() }}<br><br>

Description<br>
{{ $group->getDescription() }}<br><br>

Graduating Year<br>
{{ $group->getGraduatingYear() }}<br><br>

Max Size / Current Buddies<br>
{{ $group->getMaxSize() }} / {{ $group->getBuddyCount() }}<br><br>

Admin<br>
{{ $group->getAdminName() }}<br><br>

Co-Admin<br>
{{ $group->getCoAdminName() }}<br><br>

@if ($group->hasSpots() && !$group->inGroup(Auth::user()->id))
@include('group.partials.view.join-modal')
@endif

more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
more content<br>
@stop