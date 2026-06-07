<!DOCTYPE html>
@php
    $lang = Session::get('language');
@endphp
<html lang="{{ $lang->code ?? 'en' }}" dir="{{ $lang && $lang->is_rtl ? 'rtl' : 'ltr' }}">

<head>
    @if ($lang && $lang->is_rtl)
        <link href="{{ asset('assets/home_page/css/style-rtl.css') }}" rel="stylesheet">
    @endif
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta property="og:title" content="{{ $systemSettings['system_name'] ?? 'Boss Learning' }}">
    <meta property="og:image" content="{{ $systemSettings['horizontal_logo'] ?? asset('assets/home_page/images/logo.png') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:description" content="{{ $systemSettings['tag_line'] ?? 'Boss Learning' }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')
        {{-- {{ config('app.name') }} --}}
        {{ $systemSettings['system_name'] ?? 'Boss Learning' }}
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @include('layouts.home_page.include')
    @yield('css')
</head>

<body class="sidebar-fixed">
    <div class="container-scroller">

        @yield('content')

        @include('layouts.home_page.footer')
    </div>
    <script>
        let originalFormat = "{{ $originalDateFormat }}";
        let jsReplacedDateFormat = originalFormat; // reset every time
        jsReplacedDateFormat = jsReplacedDateFormat
            .replace(/d/g, "DD")
            .replace(/m/g, "MM")
            .replace(/Y/g, "YYYY");
        let datepickerReplacedFormat = originalFormat
        datepickerReplacedFormat = datepickerReplacedFormat
            .replace(/d/g, "dd")
            .replace(/m/g, "mm")
            .replace(/Y/g, "yyyy");
    </script>
    @include('layouts.home_page.footer_js')
    @yield('js')
    @yield('script')
</body>

</html>
