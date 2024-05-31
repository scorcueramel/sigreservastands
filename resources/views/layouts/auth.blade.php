<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link rel="stylesheet" href="{{asset('assets/css/sign-in.css')}}">

    @stack('css')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('components.colot-theme')


            @yield('content')


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha512-k2WPPrSgRFI6cTaHHhJdc8kAXaRM4JBFEDo1pPGGlYiOyv4vnA0Pp0G5XMYYxgAPmtmv/IIaQA6n5fLAyJaFMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                let actived = 'active';

                var btnActive = $('#button-dark');
                var btnActive1 = $('#button-light');
                let gettheme = sessionStorage.getItem("theme");
                $('html').attr('data-bs-theme', gettheme);
                if (gettheme == 'dark') {
                    btnActive.addClass(actived);
                }
                if (gettheme == 'light') {
                    btnActive1.addClass(actived);
                }
                $('#button-dark').click(() => {
                    let dt = $('html').removeAttr('data-bs-theme');
                    let theme = 'dark';
                    sessionStorage.setItem("theme", theme);
                    let dark = sessionStorage.getItem("theme");
                    dt.attr('data-bs-theme', dark);
                    btnActive.addClass(actived);
                    btnActive1.removeClass(actived);
                });
                $('#button-light').click(() => {
                    let dt = $('html').removeAttr('data-bs-theme');
                    let theme = 'light';
                    sessionStorage.setItem("theme", theme);
                    let light = sessionStorage.getItem("theme");
                    dt.attr('data-bs-theme', light);
                    btnActive1.addClass(actived);
                    btnActive.removeClass(actived);
                });

            });
        </script>

        @stack('js')
    </div>
</body>

</html>
