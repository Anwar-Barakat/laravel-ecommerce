<!doctype html>
<html @if (App::getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf_token" value="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('backend/static/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('backend/static/favicon.ico') }}" type="image/x-icon">
    <title>@yield('pageTitle')</title>

    <!-- CSS files -->
    @include('layouts.inc.head')
    @livewireStyles
</head>

<body>
    <script src="{{ asset('backend/dist/js/demo-theme.min.js?1674944402') }}"></script>
    <div class="page">
        <!-- Navbar -->
        @include('layouts.inc.header')

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <a href="{{ route('admin.dashboard') }}" class="page-pretitle">
                                @yield('breadcrumbSubtitle')
                            </a>
                            <h2 class="page-title">
                                @yield('breadcrumbTitle')
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <span class="d-none d-sm-inline">
                                    <a href="#" class="btn">
                                        {{ __('msgs.create', ['name' => __('dash.invoice')]) }}
                                    </a>
                                </span>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    {{ __('msgs.create', ['name' => __('product.product')]) }}
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    {{ $slot }}
                </div>
            </div>
            @include('layouts.inc.footer')
        </div>
    </div>

    <!-- Libs JS -->
    @include('layouts.inc.footer-scripts')
    @livewireScripts
</body>

</html>
