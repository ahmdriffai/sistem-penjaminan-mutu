
<li class="menu-header small text-uppercase text-white">
    <span class="menu-header-text">Informasi</span>
</li>

<li class="menu-item {{ Route::is('pengumuman.*') ? 'active' : '' }}">
    <a href="{{ route('pengumuman.index') }}" class="menu-link text-white">
        <i class="menu-icon tf-icons bx bx-paperclip"></i>
        <div data-i18n="Analytics">Pengumuman</div>
    </a>
</li>

<li class="menu-item {{ Route::is('berita.*') ? 'active' : '' }}">
    <a href="{{ route('berita.index') }}" class="menu-link text-white">
        <i class="menu-icon tf-icons bx bx-news"></i>
        <div data-i18n="Analytics">Berita</div>
    </a>
</li>
