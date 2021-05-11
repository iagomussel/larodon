<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Sistemas de gestão para clinicas">
    <meta name="author" content="Iago mussel">
    <title>{{ config('app.name') }}</title>
    <!-- CSS -->
    @section('styles')
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" type="text/css" media="screen" charset="utf-8" />
        <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('/css/select2-bootstrap.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/template.css') }}" />
    @show
    <!-- JS -->
    <script type="text/javascript" src='{{ asset('/js/jquery.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('/js/popper.js') }}'></script>
    <script type="text/javascript" src='{{ asset('/js/bootstrap.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('/js/select2.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('/js/select2.min.pt-BR.js') }}'></script>
    <script type="text/javascript" src='{{ asset('/js/bootstrap-datepicker.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('/js/bootstrap-datepicker.pt-BR.min.js') }}'></script>

    <script type="text/javascript" src='{{ asset('/js/moment.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('/js/bootstrap-confirmation.js') }}'></script>

</head>

<body>
