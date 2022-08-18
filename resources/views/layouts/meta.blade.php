<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="apple-touch-icon" sizes="180x180" href="{!! url('/').'/favicon' !!}/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="{!! url('/').'/favicon' !!}/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="{!! url('/').'/favicon' !!}/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="{!! url('/').'/favicon' !!}/manifest.json">
	<link rel="mask-icon" href="{!! url('/').'/favicon' !!}/safari-pinned-tab.svg" color="#00afff">
	<link rel="shortcut icon" href="{!! url('/').'/favicon' !!}/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="SAM">
	<meta name="application-name" content="SAM">
	<meta name="msapplication-config" content="{!! url('/').'/favicon' !!}/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>SAM</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    {!! Html::style('css/main.css') !!}
    {!! Html::style('css/bootstrap.min.css') !!}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    {!! Html::style('css/simple-sidebar.css') !!}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">


    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">