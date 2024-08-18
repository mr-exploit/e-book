<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('image/MSGLogo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('simplelineicons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    @stack('styles')
</head>

<body>

    @include('layouts.header')

    {{-- <main> --}}
    @yield('content')
    {{-- </main> --}}

    @include('layouts.footer')
    <script type="text/javascript" src="{{ asset('js/flatpickr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/apexchart.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/timePicker.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/chart.umd.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chartjs-plugin-datalabels.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/gauge.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ag-grid-community.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hamburger.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
    @yield('scripts')
</body>

</html>