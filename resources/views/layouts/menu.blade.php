<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
</li>
<li class="{{ Request::is('plans*') ? 'active' : '' }}">
    <a href="{{ route('plans.index') }}"><i class="fas fa-rocket"></i><span>@lang('models/plans.plural')</span></a>
</li>
<li class="{{ Request::is('contohs*') ? 'active' : '' }}">
    <a href="{{ route('contohs.index') }}"><i class="fas fa-rocket"></i><span>@lang('models/contohs.plural')</span></a>
</li>