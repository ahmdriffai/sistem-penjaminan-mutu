<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('/') }}"
    data-template="vertical-menu-template-free"
>
<head>
    @include('layouts.head')
    @yield('style')
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('layouts.components.sidebar')

        <!-- Layout container -->
        <div class="layout-page">

            @include('layouts.components.navbar')

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h3 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">{{ $title ?? '' }}
                    </h3>

                    @include('layouts.components.validation')

                    @yield('content')
                </div>
                <!-- / Content -->


                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
{{--    @include('layouts.components.footer')--}}


    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


@include('layouts.script')
@yield('script')
@include('layouts.components.alert')
</body>
</html>
