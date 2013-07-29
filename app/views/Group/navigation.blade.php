<ul class="nav nav-list side-navigation fixed">
  <li{{ $active_link == 'group' ? ' class="active"' : '' }}>{{ HTML::link(URL::route('group'), 'Study Groups') }}</li>
  <li{{ $active_link == 'group.myGroups' ? ' class="active"' : '' }}>{{ HTML::link(URL::route('group.myGroups'), 'My Study Groups') }}</li>
  <li{{ $active_link == 'group.create' ? ' class="active"' : '' }}>{{ HTML::link(URL::route('group.create'), 'Create Group') }}</li>
</ul>