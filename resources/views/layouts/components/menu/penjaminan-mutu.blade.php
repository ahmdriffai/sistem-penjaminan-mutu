<li class="menu-header small text-uppercase text-white">
    <span class="menu-header-text">Penjaminan Mutu</span>
</li>

<li class="menu-item {{ Route::is('penjaminan-mutu.*') ? 'active' : '' }}">
    <a href="{{ route('penjaminan-mutu.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-archive"></i>
        <div data-i18n="Analytics">Item Penjaminan Mutu</div>
    </a>
</li>

<li class="menu-item {{ Route::is('dokumen-mutu.*') ? 'active' : '' }}">
    <a href="{{ route('dokumen-mutu.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-file-archive"></i>
        <div data-i18n="Analytics">Dok. Penjaminan Mutu</div>
    </a>
</li>

<li class="menu-item">
    <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Analytics">Manual Mutu</div>
    </a>
</li>

<li class="menu-item">
    <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Analytics">SOP</div>
    </a>
</li>

<li class="menu-item">
    <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Analytics">Intruksi Kerja</div>
    </a>
</li>

<li class="menu-item">
    <a href="" class="menu-link">
        <i class="menu-icon tf-icons bx bx-dots-horizontal"></i>
        <div data-i18n="Analytics">Lebih Banyak</div>
    </a>
</li>
