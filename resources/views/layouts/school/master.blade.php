<!DOCTYPE html>
@php
    $lang = Session::get('language');
    $dir = 'ltr';
    if ($lang && $lang->is_rtl) {
        $dir = 'rtl';
    }else {
        $dir = 'ltr';
    }
@endphp
@if($lang)
    @if ($lang->is_rtl)
        <html lang="{{ $lang->code ?? 'en' }}" dir="rtl">
    @else
        <html lang="{{ $lang->code ?? 'en' }}" dir="ltr">
    @endif
@else
    <html lang="en" dir="ltr">
@endif
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>
        @yield('title') || 
        {{-- {{ config('app.name') }} --}}
        {{ $schoolSettings['school_name'] ?? 'Boss Learning' }}
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if($lang && $lang->is_rtl)
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
        <style>body, * { font-family: 'Tajawal', sans-serif !important; }</style>
    @endif
    @include('layouts.school.include')
    @yield('css')
</head>
<body style="background-color: #F4F9F5">
    {{-- header --}}
    @include('layouts.school.header')
    <div class="main">
        @php
        $lang = Session::get('language');
        $dir = 'ltr';
        if ($lang && $lang->is_rtl) {
            $dir = 'rtl';
        }else {
            $dir = 'ltr';
        }
    @endphp
        @yield('content')
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

    {{-- footer --}}
@include('layouts.school.footer')
@include('layouts.school.footer_js')
@yield('js')
@yield('script')
</body>
</html>
