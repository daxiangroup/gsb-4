<ul class="nav nav-list side-navigation fixed">
  <li{{ $active_link == 'buddy.view' ? ' class="active"' : '' }}>{{ HTML::link(URL::route('buddy.view', $buddy->getId()), 'Buddy Info') }}</li>
  {{-- TODO: This link needs to know if the profile is already on my buddy list --}}
  <li{{ $active_link == 'buddy.add' ? ' class="active"' : '' }}>{{ HTML::link(URL::route('group.myGroups'), 'Add to Buddy List') }}</li>
</ul>