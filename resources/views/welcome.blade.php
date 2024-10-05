<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- PWA  -->
    <meta name="theme-color" content="#222D32" />
    <link rel="shortcut icon" href="{{ asset('static/img/favicon.png') }}" type="image/x-icon">

    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">

    <!-- dataTables -->
    <link rel="stylesheet" href="{{ asset('static/js/pwa/dataTables.bootstrap4.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="{{ asset('static/js/pwa/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('static/plugins/select2/css/select2.min.css') }}">
    <script src="{{ asset('static/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('static/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <!-- Scripts -->
    {{-- SB Admin 2 Script --}}
    <script src="{{ asset('static/js/pwa/app.js') }}" defer></script>
    <script src="{{ asset('static/js/pwa/bootstrap.bundle.min.js') }}" defer></script>
    <!-- dataTables -->
    <script src="{{ asset('static/js/pwa/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('static/js/pwa/dataTables.bootstrap4.min.js') }}"></script>
    {{-- PWA Worker --}}
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        window.App = {
            !!json_encode(['url' => url('/'), 'token' => csrf_token(), 'name' => config('app.name')]) !!
        };
        @auth
        window.Auth = {
            !!json_encode(auth() - > ser() - > only(['npk', 'name']), ) !!
        };
        @endauth
    </script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                }, (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                }, );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>

    <script>
        function runningTime() {
            var date = new Date();

            document.getElementById('current-time').innerHTML = date.toLocaleString('en-UK', {
                timeZone: 'Asia/Jakarta'
            });;
        }

        setInterval(runningTime, 1000);
    </script>

    <script>
        function underDevelopment() {
            Swal.fire({
                imageUrl: "{{ asset('static/css/pwa/images/coming-soon.jpg') }}",
                imageHeight: 150,
                title: "Coming Soon",
                text: "This Fiture On Under Development",
                imageAlt: "Under Development"
            });
        }

        function showLoading() {
            var loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.style.display = 'flex';
            }
        }

        function hideLoading() {
            var loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var loadElements = document.querySelectorAll('.load');

            loadElements.forEach(function(element) {
                element.addEventListener('click', function(event) {
                    showLoading();
                });
            });
        });

        window.addEventListener('load', function() {
            hideLoading();
        });
    </script>

    <script>
        function deleteConfirmation(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    container: 'swal2-container-custom',
                    confirmButton: 'btn btn-info'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = event.target.closest('form');
                    if (form) {
                        form.submit();
                    }

                    Swal.fire(
                        'Deleted!', 'Your file has been deleted.', 'success'
                    );
                }
            });
        }
    </script> <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('static/css/pwa/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('static/css/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <style>
        .bg-dark {
            background-color: #222D32 !important;
        }
    </style>
    <style>
        /*Form fields*/
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            /*text-gray-700*/
            padding-left: 1rem;
            /*pl-4*/
            padding-right: 1rem;
            /*pl-4*/
            padding-top: .5rem;
            /*pl-2*/
            padding-bottom: .5rem;
            /*pl-2*/
            line-height: 1.25;
            /*leading-tight*/
            border-width: 2px;
            /*border-2*/
            border-radius: .25rem;
            border-color: #edf2f7;
            /*border-gray-200*/
            background-color: #edf2f7;
            /*bg-gray-200*/
        }

        /*Row Hover*/
        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;
            /*bg-indigo-100*/
        }

        /*Pagination Buttons*/
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Current selected */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Add padding to bottom border */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            /*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }

        /*Change colour of responsive icon*/
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #667eea !important;
            /*bg-indigo-500*/
        }

        mark {
            @apply inline-block pr-1 pl-1 py-0;
            margin-top: 0.15rem;
            margin-bottom: 0.15rem;
        }

        .mark-rounded {
            @apply rounded-sm shadow-md;
        }

        .mark-teal {
            @apply bg-teal-500 text-white;
        }

        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .loader {
            width: 80px;
            height: 40px;
            border-radius: 100px 100px 0 0;
            position: relative;
            overflow: hidden;
        }

        .loader:before {
            content: "";
            position: absolute;
            inset: 0 0 -100%;
            background:
                radial-gradient(farthest-side, #ffd738 80%, #0000) left 70% top 20%/15px 15px,
                radial-gradient(farthest-side, #020308 92%, #0000) left 65% bottom 19%/12px 12px,
                radial-gradient(farthest-side, #ecfefe 92%, #0000) left 70% bottom 20%/15px 15px,
                linear-gradient(#9eddfe 50%, #020308 0);
            background-repeat: no-repeat;
            animation: l5 2s infinite;
        }

        @keyframes l5 {

            0%,
            20% {
                transform: rotate(0)
            }

            40%,
            60% {
                transform: rotate(.5turn)
            }

            80%,
            100% {
                transform: rotate(1turn)
            }
        }

        .pull-right {
            float: right !important;
            text-align: right !important;
        }
    </style>
    @yield('css')
    @stack('css')
</head>

<body class="bg-gradient-dark">
    <main id="app">
        <div id="loading-overlay">
            <div class="loader"></div>
        </div>
        <div id="page-top">
            <div id="wrapper">
                <div id="content-wrapper" class="d-flex flex-column">
                    <div id="content">
                        @include('layouts.navbar')
                        @yield('content')
                    </div>
                    <div class="centered">
                        <div class="plus" id="plus">
                            <div class="plus__line plus__line--v">
                                <a href="#" class="plus__link ion-person"></a>
                                <a href="#" class="plus__link ion-images"></a>
                                <a href="#" class="plus__link ion-music-note"></a>
                                <a href="#" class="plus__link ion-location"></a>
                            </div>
                            <div class="plus__line plus__line--h"></div>
                        </div>
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </main>
    @yield('js')
    @stack('js')
</body>

</html>
