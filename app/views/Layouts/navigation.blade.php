<ul class="main-navigation">
    @if (!Auth::guest())
    <li>
        {{ HTML::link(URL::route('dashboard'), 'Dashboard') }}
    </li>
    <li>
        <div class="dropdown">
            {{ HTML::link(URL::route('profile'), 'Profile Settings') }}
            {{ HTML::decode(HTML::link('#', '<span class="caret"></span>', array('data-toggle'=>'dropdown', 'class'=>'dropdown-toggle', 'data-target'=>'#'))) }}
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <li>{{ HTML::link(URL::route('profile'), 'Account', array('tabindex'=>'-1')) }}</li>
                <li>{{ HTML::link(URL::route('profile.password'), 'Password', array('tabindex'=>'-1')) }}</li>
                <li>{{ HTML::link(URL::route('profile.settings'), 'Profile Settings', array('tabindex'=>'-1')) }}</li>
            </ul>
        </div>
    </li>
    <li>
        <div class="dropdown">
            {{ HTML::link(URL::route('group'), 'Study Groups') }}
            {{ HTML::decode(HTML::link('#', '<span class="caret"></span>', array('data-toggle'=>'dropdown', 'class'=>'dropdown-toggle', 'data-target'=>'#'))) }}
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <li>{{ HTML::link(URL::route('group'), 'Study Groups', array('tabindex'=>'-1')) }}</li>
                <li>{{ HTML::link(URL::route('group.myGroups'), 'My Study Groups', array('tabindex'=>'-1')) }}</li>
                <li>{{ HTML::link(URL::route('group.create'), 'Create Group', array('tabindex'=>'-1')) }}</li>
            </ul>
        </div>
    </li>
    <li>{{ HTML::link(URL::route('logout'), 'Logout') }}</li>
    @endif
</ul>
