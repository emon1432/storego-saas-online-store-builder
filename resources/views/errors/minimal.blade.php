<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') &dash; {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset(Storage::url('uploads/logo/favicon.png')) }}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.min.css') }}" />
    <!-- font css -->
    <link rel="stylesheet" href="{{asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{asset('assets/fonts/material.css') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{asset('assets/css/customizer.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/landing.css') }}"/>
</head>
@php
    $user = \Auth::user();
@endphp
<body>
@yield('content')

<script src="{{ asset('assets/js/plugins/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/wow.min.js')}}"></script>
</body>
</html>
