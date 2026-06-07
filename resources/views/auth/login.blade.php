<!DOCTYPE html>
@php
    $lang = Session::get('language');
    $isRtl = $lang && $lang->is_rtl;
@endphp
@if($lang)
    @if ($lang->is_rtl)
        <html lang="{{ $lang->code ?? 'ar' }}" dir="rtl">
    @else
        <html lang="{{ $lang->code ?? 'en' }}" dir="ltr">
    @endif
@else
    <html lang="en" dir="ltr">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('login') }} || {{ $systemSettings['system_name'] ?? config('app.name') }}</title>

    {{-- Bootstrap base --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('/assets/fonts/font-awesome.min.css') }}">

    {{-- Noto Sans Arabic — best Arabic+Latin coverage --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Boss Learning Design System --}}
    <link href="{{ asset('assets/css/boss-learning.css') }}" rel="stylesheet">

    {{-- Toast notifications --}}
    <link rel="stylesheet" href="{{ asset('/assets/jquery-toast-plugin/jquery.toast.min.css') }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ $schoolSettings['favicon'] ?? $systemSettings['favicon'] ?? url('assets/vertical-logo.svg') }}"/>

    <style>
        * { font-family: 'Noto Sans Arabic', Arial, sans-serif !important; }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: var(--bl-surface);
        }

        /* Ensure login split wrapper fills viewport */
        .login-split-wrapper {
            min-height: 100vh;
        }

        /* RTL: branding panel on right, form on left */
        html[dir="rtl"] .login-split-wrapper {
            flex-direction: row-reverse;
        }

        /* RTL brand features bullet — flip alignment */
        html[dir="rtl"] .login-brand-panel .brand-features li {
            flex-direction: row-reverse;
            text-align: right;
        }

        /* Override any a color */
        a.forgot-link, a.forgot-link:visited {
            color: var(--bl-secondary) !important;
        }
        a { color: var(--bl-primary) !important; }

        /* Input group icon */
        .input-icon-wrapper {
            position: relative;
        }
        .input-icon-wrapper .input-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: var(--bl-text-placeholder);
            font-size: 0.9rem;
            z-index: 5;
        }
        html[dir="ltr"] .input-icon-wrapper .input-icon { right: 14px; }
        html[dir="rtl"] .input-icon-wrapper .input-icon { left: 14px; }

        html[dir="ltr"] .input-icon-wrapper .form-control { padding-right: 2.5rem !important; }
        html[dir="rtl"] .input-icon-wrapper .form-control { padding-left: 2.5rem !important; }

        .toggle-password {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--bl-text-placeholder);
            z-index: 5;
            padding: 0 4px;
        }
        html[dir="ltr"] .toggle-password { left: 12px; }
        html[dir="rtl"] .toggle-password { right: 12px; }

        /* Remember me / forgot row */
        .login-meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin: 0.75rem 0 1.5rem;
        }

        /* Demo credentials section */
        .demo-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--bl-surface-border);
        }
        .demo-section .demo-title {
            text-align: center;
            font-size: 0.8rem;
            color: var(--bl-text-placeholder);
            margin-bottom: 1rem;
        }
        .demo-section .btn-demo {
            font-size: 0.78rem;
            padding: 6px 12px;
            border-radius: var(--bl-radius);
            border: 1px solid var(--bl-surface-border);
            background: var(--bl-surface);
            color: var(--bl-text-muted);
            cursor: pointer;
            transition: var(--bl-transition);
        }
        .demo-section .btn-demo:hover {
            background: var(--bl-primary);
            color: #fff;
            border-color: var(--bl-primary);
        }

        /* Alert styling */
        .alert { border-radius: var(--bl-radius) !important; font-size: 0.875rem; }
    </style>

    <script async src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
<div class="login-split-wrapper">

    {{-- ═══════════════════════════════════════
         FORM PANEL
    ═══════════════════════════════════════ --}}
    <div class="login-form-panel">

        {{-- Logo --}}
        <div class="login-logo">
            @if ($schoolSettings['horizontal_logo'] ?? '')
                <img class="img-fluid" style="max-height:56px;" src="{{ $schoolSettings['horizontal_logo'] }}" alt="logo">
            @elseif($systemSettings['login_page_logo'] ?? $systemSettings['horizontal_logo'] ?? '')
                <img class="img-fluid" style="max-height:56px;" src="{{ $systemSettings['login_page_logo'] ?? $systemSettings['horizontal_logo'] }}" alt="logo">
            @else
                {{ $systemSettings['system_name'] ?? 'Boss Learning' }}
            @endif
        </div>

        {{-- Welcome headline --}}
        <h1 class="login-welcome">
            @if($isRtl)مرحباً بعودتك@else{{ __('Welcome Back') }}@endif
        </h1>
        <p class="login-subtitle">
            @if($isRtl)سجّل دخولك إلى منصة {{ $systemSettings['system_name'] ?? 'بوس ليرنينج' }}@else{{ __('Sign in to') }} {{ $systemSettings['system_name'] ?? config('app.name') }}@endif
        </p>

        {{-- Alerts --}}
        <div class="mb-3">
            @if(Session::has('emailSuccess'))
                <div class="alert alert-success" role="alert">{{ Session::get('emailSuccess') }}</div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                <div class="alert alert-success" role="alert">{{ __('please_ensure_login') }}</div>
            @endif
            @if(Session::has('emailError'))
                <div class="alert alert-danger" role="alert">{{ Session::get('emailError') }}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif
            @if(env('DEMO_MODE'))
                <div class="alert alert-info" role="alert">
                    NOTE: <a target="_blank" href="{{ url('/login') }}">-- Click Here --</a> if you cannot login.
                </div>
            @endif
        </div>

        {{-- Login Form --}}
        <form action="{{ route('login') }}" id="frmLogin" method="POST">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('email') }}</label>
                <div class="input-icon-wrapper">
                    <input id="email" type="text"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ isset($school) && !empty($school) && $school->type == 'demo' ? $school->user->email : old('email') }}"
                        required autocomplete="email" autofocus
                        placeholder="{{ __('email_or_mobile') }}">
                    <i class="fa fa-envelope input-icon"></i>
                </div>
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('password') }}</label>
                <div class="input-icon-wrapper">
                    <input id="password" type="password"
                        class="form-control form-control-lg"
                        name="password" required
                        value="{{ isset($school) && !empty($school) && $school->type == 'demo' ? $school->user->mobile : '' }}"
                        autocomplete="current-password"
                        placeholder="{{ __('password') }}">
                    <button type="button" class="toggle-password" id="togglePasswordShowHide" title="{{ __('show_hide_password', [], null) ?? 'Show/Hide' }}">
                        <i class="fa fa-eye-slash" id="togglePassword"></i>
                    </button>
                </div>
            </div>

            {{-- School Code --}}
            @if ($school ?? '')
                <div class="mb-3 d-none">
                    <label for="school_code" class="form-label">{{ __('school_code') }}</label>
                    <input id="school_code" type="text" class="form-control" name="code"
                        value="{{ $school->code }}" placeholder="{{ __('school_code') }}">
                </div>
            @else
                <div class="mb-3">
                    <label for="school_code" class="form-label">{{ __('school_code') }}</label>
                    <input id="school_code" type="text" class="form-control form-control-lg" name="code"
                        value="{{ old('school_code') }}" placeholder="{{ __('school_code') }}">
                </div>
            @endif

            {{-- Remember + Forgot --}}
            <div class="login-meta-row">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                    <label class="form-check-label" for="remember-me" style="font-size:0.85rem;">
                        @if($isRtl)تذكّرني@else{{ __('Remember Me') }}@endif
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">{{ __('forgot_password') }}</a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit" name="btnlogin" id="login_btn" class="btn-login btn">
                {{ __('login') }}
            </button>

        </form>

        {{-- New user / registration link --}}
        <div class="text-center mt-4" style="font-size:0.85rem; color:var(--bl-text-muted);">
            <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
               style="color:var(--bl-primary)!important;font-weight:500;">
                {{ __('New user Sign up to manage your school activities seamlessly') }}
            </a>
        </div>

        {{-- Demo credentials (only in demo mode) --}}
        @if(env('DEMO_MODE'))
            <div class="demo-section">
                <div class="demo-title">Demo Credentials</div>

                @if(empty($school))
                    <div class="text-center mb-2" style="font-size:0.75rem;color:var(--bl-text-placeholder);">Super Admin Panels</div>
                    <div class="row g-2 mb-3">
                        <div class="col-6"><button class="btn-demo w-100" id="superadmin_btn">Super Admin</button></div>
                        <div class="col-6"><button class="btn-demo w-100" id="superadmin_staff_btn">Staff</button></div>
                    </div>
                @endif

                <div class="text-center mb-2" style="font-size:0.75rem;color:var(--bl-text-placeholder);">School Admin Panels</div>
                <div class="row g-2">
                    <div class="col-4"><button class="btn-demo w-100" id="schooladmin_btn">School Admin</button></div>
                    <div class="col-4"><button class="btn-demo w-100" id="teacher_btn">Teacher</button></div>
                    <div class="col-4"><button class="btn-demo w-100" id="schooladmin_staff_btn">Staff</button></div>
                </div>
            </div>
        @endif
    </div>

    {{-- ═══════════════════════════════════════
         BRANDING PANEL
    ═══════════════════════════════════════ --}}
    <div class="login-brand-panel">
        <div class="blob-1"></div>
        <div class="blob-2"></div>
        <div class="pattern-overlay"></div>

        {{-- School emblem --}}
        <div class="school-emblem">
            @if($schoolSettings['vertical_logo'] ?? '')
                <img src="{{ $schoolSettings['vertical_logo'] }}" alt="logo" style="width:56px;height:56px;object-fit:contain;border-radius:12px;">
            @elseif($systemSettings['vertical_logo'] ?? '')
                <img src="{{ $systemSettings['vertical_logo'] }}" alt="logo" style="width:56px;height:56px;object-fit:contain;border-radius:12px;">
            @else
                <i class="fa fa-graduation-cap"></i>
            @endif
        </div>

        {{-- Headline --}}
        <h2 class="brand-headline">
            @if($isRtl)
                منصة إدارة المدارس الأردنية
            @else
                {{ $systemSettings['system_name'] ?? 'Boss Learning' }}
            @endif
        </h2>

        <p class="brand-sub">
            @if($isRtl)
                نظام متكامل يربط بين الإدارة، المعلمين، والطلاب لتجربة تعليمية راقية
            @else
                A complete school management platform for academic excellence
            @endif
        </p>

        {{-- Feature list --}}
        <ul class="brand-features">
            <li>@if($isRtl)التميز الأكاديمي@else Academic Excellence @endif</li>
            <li>@if($isRtl)الثقة والمصداقية@else Trust & Reliability @endif</li>
            <li>@if($isRtl)الابتكار التعليمي@else Educational Innovation @endif</li>
        </ul>
    </div>

</div>{{-- /.login-split-wrapper --}}

{{-- Registration modal: placed outside the split-screen wrapper to avoid div count issues --}}
@include('registration_form')

{{-- Scripts --}}
<script src="{{ asset('/assets/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('/assets/js/custom/common.js') }}"></script>
<script src="{{ asset('/assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('/assets/js/custom/function.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<script>
    // Form validation
    $("#frmLogin").validate({
        rules: { email: "required", password: "required" },
        success: function (label, element) {
            $(element).parent().removeClass('has-danger');
            $(element).removeClass('form-control-danger');
        },
        errorPlacement: function (label, element) {
            if (label.text()) {
                if ($(element).attr("name") === "password") {
                    label.insertAfter(element.parent()).addClass('text-danger mt-2 d-block');
                } else {
                    label.addClass('mt-2 text-danger d-block');
                    label.insertAfter(element);
                }
            }
        },
        highlight: function (element) {
            $(element).parent().addClass('has-danger');
            $(element).addClass('form-control-danger');
        }
    });

    // Password toggle
    document.getElementById('togglePasswordShowHide').addEventListener('click', function () {
        const pwd = document.getElementById('password');
        const icon = document.getElementById('togglePassword');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            pwd.type = 'password';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    });

    @if(env('DEMO_MODE'))
        const fillAndSubmit = (email, password, code) => {
            $('#email').val(email);
            $('#password').val(password);
            if (code) $('#school_code').val(code);
            $('#login_btn').attr('disabled', true);
            $('#frmLogin').submit();
        };

        $('#superadmin_btn').on('click',       () => fillAndSubmit('superadmin@gmail.com', 'superadmin'));
        $('#superadmin_staff_btn').on('click',  () => fillAndSubmit('mahesh@gmail.com', 'staff@123'));
        $('#schooladmin_btn').on('click',       () => fillAndSubmit('school1@gmail.com', 'school@123', 'SCH202412'));
        $('#teacher_btn').on('click',           () => fillAndSubmit('teacher@gmail.com', '0111111111', 'SCH202412'));
        $('#schooladmin_staff_btn').on('click', () => fillAndSubmit('smitc@gmail.com', '965555885', 'SCH202412'));
    @endif

    const please_wait = "{{ __('Please wait') }}";
    const processing_your_request = "{{ __('Processing your request') }}";
</script>

@if(Session::has('error'))
    <script>
        $.toast({ text: '{{ Session::get('error') }}', showHideTransition: 'slide', icon: 'error', loaderBg: '#f2a654', position: 'top-right' });
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            $.toast({ text: '{{ $error }}', showHideTransition: 'slide', icon: 'error', loaderBg: '#f2a654', position: 'top-right' });
        </script>
    @endforeach
@endif

</body>
</html>