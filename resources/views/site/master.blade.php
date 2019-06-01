<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{url('css/admin.css')}}">
    <link rel="stylesheet" href="{{url('css/custom.css')}}">
    <link rel="stylesheet" href="{{url('css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{url('css/flipclock.css')}}">
    <link rel="stylesheet" href="{{url('css/site.css')}}">
    <script src="{{url('js/home.js')}}"></script>


    @yield('style')
    <title>
        @yield('title')
    </title>
</head>
<body>

@include('site.section.header')

 @yield('content')

 @include('site.section.footer' )
