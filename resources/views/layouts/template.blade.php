<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Info -->
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title','2FA-Laravel')</title>

        {{-- Bootstrap 5 --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha256-3gQJhtmj7YnV1fmtbVcnAV6eI4ws0Tr48bVZCThtCGQ=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha256-jTIdiMuX/e3DGJUGwl3pKSxuc6YOuqtJYkM0bGQESA4=" crossorigin="anonymous">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/core.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/icon-font.min.css')}}" />
        @stack('page-css')
        <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/sweetalert2/sweetalert2.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/style.css')}}" />
        @stack('custom-css')
        <script type="text/javascript">
            const BASE_URL = '{{url("")}}/';
            const ASSET_URL = '{{asset("")}}';
        </script>
    </head>
    <body class="header-white sidebar-light">
        @include('layouts.pre-loader')

        @include('layouts.header')

        @include('layouts.sidebar')

        <div class="mobile-menu-overlay"></div>

        <div class="main-container">
            @yield('content')
        </div>
        @include('layouts.model');

        <script src="{{asset('vendors/scripts/core.js')}}"></script>
        <script src="{{asset('vendors/scripts/script.min.js')}}"></script>
        <script src="{{asset('vendors/scripts/process.js')}}"></script>
        <script src="{{asset('src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
        <script src="{{asset('vendors/scripts/bootstrap-modal.js')}}"></script>
        @stack('scripts')
    </body>
</html>
