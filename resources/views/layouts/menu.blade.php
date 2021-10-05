<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('qws.index') }}"
       class="nav-link {{ Request::is('qws*') ? 'active' : '' }}">
        <p>@lang('models/qws.plural')</p>
    </a>
</li>

