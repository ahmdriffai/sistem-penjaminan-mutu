<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ asset('logo-alpha.png') }}" class="img-fluid" width="60px">
              </span>
            <span class="app-brand-text demo menu-text text-white fw-bolder ms-2 text-uppercase">SPMI</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Route::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        @include('layouts.components.menu.penjaminan-mutu')
        @include('layouts.components.menu.paper-ilmiah')
        @include('layouts.components.menu.informasi')
        @include('layouts.components.menu.manajemen')

    </ul>
</aside>
<!-- / Menu -->