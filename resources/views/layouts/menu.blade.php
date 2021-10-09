<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
</li>
<li class="{{ Request::is('safitris*') ? 'active' : '' }}">
    <a href="{{ route('safitris.index') }}"><i class="fa fa-edit"></i><span>@lang('models/safitris.plural')</span></a>
</li>

