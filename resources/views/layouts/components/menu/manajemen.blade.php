<li class="menu-header small text-uppercase text-white">
    <span class="menu-header-text">Manajemen</span>
</li>

<li class="menu-item {{ Route::is('user.*') ? 'active' : '' }}">
    <a href="{{ route('user.index') }}" class="menu-link text-white">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Analytics">Manajemen User</div>
    </a>
</li>

<li class="menu-item {{ Route::is('dosen.*') ? 'active' : '' }}">
    <a href="{{ route('dosen.index') }}" class="menu-link text-white">
        <i class="menu-icon tf-icons bx bxs-user-account"></i>
        <div data-i18n="Analytics">Manajemen Data Dosen</div>
    </a>
</li>
