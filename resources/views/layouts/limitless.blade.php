<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
        <div class="container-fluid">
            <div class="navbar-brand">
                <a href="{{ url('/') }}" class="d-inline-flex align-items-center">
                    <span class="fw-semibold">Limitless</span>
                </a>
            </div>
            <div class="d-flex justify-content-end align-items-center ms-auto">
                <ul class="navbar-nav flex-row">

                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link p-0" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a href="#" class="nav-link">
                                <div class="d-flex align-items-center mx-md-1">
                                    <i class="ph ph-lifebuoy"></i>
                                    <span class="d-none d-md-inline-block ms-2">Support</span>
                                </div>
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('register') }}"
                                    class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                                    <div class="d-flex align-items-center mx-md-1">
                                        <i class="ph ph-user-circle-plus"></i>
                                        <span class="d-none d-md-inline-block ms-2">Register</span>
                                    </div>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item"><a href="{{ route('login') }}"
                                class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                                <div class="d-flex align-items-center mx-md-1">
                                    <i class="ph ph-user-circle"></i>
                                    <span class="d-none d-md-inline-block ms-2">Login</span>
                                </div>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>

    <div class="page-content">

        @auth
            <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
                <div class="sidebar-content">
                    <div class="sidebar-section">
                        <div class="sidebar-section-body d-flex justify-content-center">
                            <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                            <div>
                                <button type="button"
                                    class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                                    <i class="ph ph-arrows-left-right"></i>
                                </button>

                                <button type="button"
                                    class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                                    <i class="ph ph-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-section">
                        <ul class="nav nav-sidebar" data-nav-type="accordion">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="ph ph-house"></i>
                                    <span>
                                        Dashboard
                                        <span class="d-block fw-normal opacity-50">No pending orders</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/users') }}" class="nav-link">
                                    <i class="ph ph-user"></i>
                                    <span>User</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('locations.index') }}" class="nav-link">
                                    <i class="ph ph-map-pin"></i>
                                    <span>Location</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('forms.index') }}" class="nav-link">
                                    <i class="ph ph-map-pin"></i>
                                    <span>Form</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @yield('content')
        @else
            @yield('content')
        @endauth

    </div>

    <div class="navbar navbar-sm navbar-footer border-top">
        <div class="container-fluid d-flex justify-content-between">
            <span class="navbar-text">
                © 2022 Limitless Web App Kit
            </span>
            <ul class="nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded" target="_blank">
                        <div class="d-flex align-items-center mx-md-1">
                            <i class="ph ph-lifebuoy"></i>
                            <span class="d-none d-md-inline-block ms-2">Support</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ms-md-1">
                    <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded" target="_blank">
                        <div class="d-flex align-items-center mx-md-1">
                            <i class="ph ph-file-text"></i>
                            <span class="d-none d-md-inline-block ms-2">Docs</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ms-md-1">
                    <a href="#"
                        class="navbar-nav-link navbar-nav-link-icon text-primary bg-primary bg-opacity-10 fw-semibold rounded"
                        target="_blank">
                        <div class="d-flex align-items-center mx-md-1">
                            <i class="ph ph-shopping-cart"></i>
                            <span class="d-none d-md-inline-block ms-2">Purchase</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
