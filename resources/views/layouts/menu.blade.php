<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
</li>
<li class="side-menus {{ Request::is('safitris*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('safitris.index') }}">
        <i class="fas fa-edit"></i><span>Kategori</span>
    </a>
</li>
<li class="side-menus {{ Request::is('safitris*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('safitris.index') }}">
        <i class="fas fa-edit"></i><span>Buku</span>
    </a>
</li>
<li class="side-menus {{ Request::is('safitris*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('safitris.index') }}">
        <i class="fas fa-edit"></i><span>Peminjaman</span>
    </a>
</li>

