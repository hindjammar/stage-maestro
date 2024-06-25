<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="contact.css"> -->
        <title>Maestro</title>

        <!-- Fonts -->
        <link rel="icon" type="image/png" href="{{ asset('images/maes.png') }}"> 
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

       
    </head>
    <body class="antialiased">
        
    <section id="navbar">@include('navbar')</section>
    <section id="stiple">@include('stiple')</section>
    <section id="about">@include('about')</section>
    <section id="contact">@include('contact')</section>
    <section id="services">@include('services')</section>
    <section id="footer">@include('footer')</section>
    

   
    </body>
</html>
