<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', App::getLocale()) }}"
    class="max-[8192px]:opacity-0 max-[3120px]:opacity-100 max-[3120px]:m-0 max-[3120px]:p-0 max-[3120px]:box-border max-[3120px]:[font-family:'Plus_Jakarta_Sans',Times,sans-serif,serif] max-[324px]:hidden"
>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index" />
    <meta name="description" content="@yield('deskripsi')" />
    <meta property="og:title" content="@yield('judul') | Politern" />
    <meta property="og:description" content="@yield('deskripsi')" />
    <meta property="og:image" content="{{ asset('shared/logo.png') }}" />
    <meta name="twitter:title" content="@yield('judul') | Politern" />
    <meta name="twitter:description" content="@yield('deskripsi')" />
    <meta name="twitter:image" content="{{ asset('shared/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('judul') | Politern</title>
    <link rel="icon" href="{{ asset('shared/logo.png') }}" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="{{ Request::routeIs('lupa-kata-sandi', 'masuk') ? 'overflow-x-hidden flex items-center justify-center min-h-screen h-full [background-image:_linear-gradient(to_right_top,_#e86bb1,_#d265b4,_#bb60b6,_#a15cb7,_#8559b6,_#8265bc,_#8070c2,_#7f7bc6,_#9b98d5,_#b8b6e3,_#d5d5f1,_#f4f4fe)]' : 'overflow-x-hidden min-h-screen h-full bg-[#fafafa]' }}">
    @auth
        @include('shared.navigation.sidebar')
    @endauth
    @yield('konten')
    @stack('skrip')
    <div id="overlay" class="hidden fixed inset-0 z-40 lg:hidden"></div>
    @livewireScripts
</body>

</html>