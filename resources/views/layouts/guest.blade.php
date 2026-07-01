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

<body>
    @include('layouts.parts.theme')
    <div class="page page-center">
        <div class="container container-tight py-4">

            <div class="card card-md">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <a href="." wire:navigate class="navbar-brand navbar-brand-autodark">
                            <x-application-logo />
                        </a>
                    </div>
                    {{ $slot }}
                </div>
            </div>
            {{ $link ?? null }}
        </div>
    </div>
    @include('layouts.parts.scripts')
</body>

</html>
