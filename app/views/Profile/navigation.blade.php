<ul class="nav nav-list side-navigation fixed">
    <li class="dropdown{{ $active_link == 'profile' ? ' active' : '' }}">{{ HTML::link(URL::route('profile'), 'Account') }}</li>
  <li{{ $active_link == 'profile.password' ? ' class="active"' : '' }}>{{ HTML::link(URL::route('profile.password'), 'Password') }}</a></li>
  <li{{ $active_link == 'profile.settings' ? ' class="active"' : '' }}>{{ HTML::link(URL::route('profile.settings'), 'Profile Settings') }}</a></li>
</ul>
