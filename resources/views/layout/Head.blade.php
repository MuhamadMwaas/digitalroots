<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="digitalroots">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projectse, management">
    <meta name="author" content="Abo Backer">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('Admin/assets/img/favicon.jpg') }}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/css/animate.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('Admin/assets/css/dataTables.bootstrap4.min.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('Admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('Admin/assets/css/style.css') }}">



    <link rel="stylesheet" href="{{ asset('Admin/assets/toasting-main/dist/css/toasting.css') }}" />

  


    {{-- style Stack --}}
    @stack('style')
    {{-- livewire --}}
    <livewire:styles />
    <livewire:scripts />
   


</head>
