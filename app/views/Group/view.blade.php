@extends('Layouts/left40')

@section('content-left')
@include('Group.navigation')
@stop

@section('page-specific-js-footer')
{{ HTML::script('js/vendors/GSB/group.js') }}
@stop

@section('page-specific-classes')
group-view @stop

@section('content-right')

<div class="page-header">
    <h2>{{ $group->getName() }}<br>
    <small>{{ $group->getHeadline() }}</small></h2>
</div>

<div class="row-fluid">
    <img src="http://placekitten.com/700/85" />
</div>

<div class="row-fluid">
    <div class="span4">
        <div class="row-fluid">
            <div class="span12" title="{{ Lang::get('Group/strings.description.visibility') }}{{ $group->visibilityName() }}">
                <i class="icon-eye-open"></i>
                {{ $group->visibilityName() }}
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <i class="icon-calendar"></i>
                Graduating in {{ $group->getGraduatingYear() }}
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12 group-controls">
                @if ($group->hasSpots() && !$group->inGroup(Auth::user()->id) && !$group->isAdmin(Auth::user()->id))
                @include('Group.partials.view.join-modal')
                @endif

                @if ($group->isAdmin(Auth::user()->id))
                {{ HTML::link(URL::route('group.edit', $group->getId()), Lang::get('Group/strings.buttons.group-edit'), array('class'=>'btn btn-primary')) }}
                @endif
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12 buddies-control">
                <i class="icon-user"></i>
                {{ $group->getBuddyCount() }} / {{ $group->getMaxSize() }} Buddies
                <span class="show-button pull-right {{ $group->getBuddyCount() ? 'icon-chevron-down' : '' }}"></span>
            </div>
            <div class="row-fluid group-buddies">
                <div class="span12">
                    <?php //die('<pre>'.print_r($group->getBuddies(),true)); ?>
                    @foreach ($group->getBuddies() as $mt => $buddy)
                    <?php //die('<pre>'.print_r($buddy,true)); ?>
                    din: {{ $buddy->id }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="span8">
        <div class="row-fluid">
            <div class="span6">
                <i class="icon-star"></i>
                {{ HTML::link(URL::route('profile.view', $group->getAdminId()), $group->getAdminName()) }}
            </div>
            <div class="span6">
                @if ($group->getCoAdminId())
                <i class="icon-star-empty"></i>
                {{ HTML::link(URL::route('profile.view', $group->getCoAdminId()), $group->getCoAdminName()) }}
                @endif
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <i class="icon-book"></i>
                {{ $group->getDescription() }}
            </div>
        </div>
    </div>
</div>


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