<li class="menu-header small text-uppercase text-white">
    <span class="menu-header-text">Lainya</span>
</li>

<li class="menu-item {{ Route::is('penelitian.*') ? 'active' : '' }}">
    <a href="{{ route('penelitian.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-vial"></i>
        <div data-i18n="Analytics">Penelitian</div>
    </a>
</li>

<li class="menu-item">
    <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-current-location"></i>
        <div data-i18n="Analytics">Pengabdian</div>
    </a>
</li>

<li class="menu-item">
    <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Analytics">Paper Ilmiah</div>
    </a>
</li>
