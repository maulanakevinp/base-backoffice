<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title') - Resto Jember</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Resto Jember" />
    <meta name="keywords" content="Resto Jember,Resto jember,Dinas Pemberdayaan Masyarakat dan Desa Jember,dinas pemberdayaan masyarakat dan desa jember,dinas pmd jember,dinas pmd">
    <meta name="author" content="Maulana Kevin Pradana" />
    <meta name="theme-color" content="#82bcff" />
    <!-- Mendeklarasikan ikon untuk iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <meta name="apple-mobile-web-app-title" content="Resto Jember" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/128x128.png') }}" />
    <!-- Mendeklarasikan ikon untuk Windows -->
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/128x128.png') }}" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="base-url" content="{{ url('') }}"/>
    <meta name="csrf" content="{{ csrf_token() }}"/>
    <link rel="manifest" href="{{ asset('/manifest.json')}}">

    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- vendor css -->
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>
<body class="">
    @auth
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->

        <!-- [ navigation menu ] start -->
        @include('layouts.components.navigation')
        <!-- [ navigation menu ] end -->

        <!-- [ Header ] start -->
        @include('layouts.components.header')
        <!-- [ Header ] end -->

        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <!-- [ breadcrumb ] end -->

                <!-- [ Main Content ] start -->
                @yield('content')
                <!-- [ Main Content ] end -->
            </div>
        </div>
        <!-- [ Main Content ] end -->

        @include('layouts.components.menu-setting')
    @else
        @yield('content')
    @endauth

    <!-- Required Js -->
    <script src="{{ url('') }}/assets/js/vendor-all.min.js"></script>
    <script src="{{ url('') }}/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    @auth
        <script src="{{ asset('assets/js/notifikasi.js') }}"></script>
    @endauth
    <script src="{{ asset('assets/js/waves.min.js') }}"></script>
    <script src="{{ url('') }}/assets/js/menu-setting.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script>
        const BASEURL = $('meta[name="base-url"]').attr('content');
        const CSRF = $('meta[name="csrf"]').attr('content');
        const LANGUAGE = {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Maaf - Tidak ada yang ditemukan",
            "info": "Tampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data yang tersedia",
            "infoFiltered": "(difilter dari _MAX_ total kolom)",
            "emptyTable": "Tidak ada data di dalam tabel",
            "search": "Cari",
            "paginate": {
                "previous": "<",
                "next": ">"
            },
            "decimal": ",",
            "thousands": "."
        };

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
    @stack('scripts')
</body>

</html>
