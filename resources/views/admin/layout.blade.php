<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('admin.dashboard') }} - {{ __('site_title') }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h3>{{ __('admin.dashboard') }}</h3>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        {{ __('admin.dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.logo') }}" class="{{ request()->routeIs('admin.logo') ? 'active' : '' }}">
                        {{ __('admin.logo_settings') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.social') }}"
                        class="{{ request()->routeIs('admin.social') ? 'active' : '' }}">
                        {{ __('admin.social_links') ?? 'Social Links' }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.slider.index') }}"
                        class="{{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
                        {{ __('admin.slider_management') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.services.index') }}"
                        class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        {{ __('admin.services_management') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.hosting_plans.index') }}"
                        class="{{ request()->routeIs('admin.hosting_plans.*') ? 'active' : '' }}">
                        {{ __('admin.hosting_plans') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.index') }}"
                        class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                        {{ __('admin.pages_management') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contact.index') }}"
                        class="{{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                        {{ __('admin.contact_methods') }}
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}" target="_blank">
                        {{ __('site_title') }} (Frontend)
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="admin-content">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-title">
                    <h2>{{ __('admin.welcome') }}</h2>
                </div>
                <div class="lang-switch">
                    <a href="{{ route('locale.switch', 'ar') }}"
                        class="{{ app()->getLocale() === 'ar' ? 'active' : '' }}">AR</a>
                    <a href="{{ route('locale.switch', 'en') }}"
                        class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                </div>
            </header>

            <!-- Main Area -->
            <main class="admin-main">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>