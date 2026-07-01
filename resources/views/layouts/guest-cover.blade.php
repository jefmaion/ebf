<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.parts.header')
</head>
<style>
    .navbar-brand-image-login {
        height: 4rem;
        width: auto;
    }
</style>

<body class="d-flex flex-column">
    @include('layouts.parts.theme')
    <div class="row g-0 flex-fill">
        <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
            <div class="container container-tight my-5 px-lg-5">
                <div class="text-center mb-4">
                   <a href="." wire:navigate class="navbar-brand navbar-brand-autodark">
                            <x-application-logo />
                        </a>
                </div>
                {{ $slot }}
                <div class="text-center text-secondary mt-3">{{ $link ?? null }}</div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
            <!-- Photo -->
            <div class="bg-cover h-100 min-vh-100"
                style="background-image: url({{ asset('template') }}/static/photos/finances-us-dollars-and-bitcoins-currency-money-2.jpg)">
            </div>
        </div>
    </div>
    @include('layouts.parts.scripts')
</body>

</html>