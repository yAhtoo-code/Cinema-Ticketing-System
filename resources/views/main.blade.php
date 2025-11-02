<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Cinematique') }}</title>
    </head>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script> 

<body class="relative"> 
<div class="absolute inset-0 bg-black/45 z-0"></div> 
<div class="relative z-10">

    <header>
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
               <img class="logo" src= "{{ asset('images/logo.png') }}" alt="Cinematique Logo">
                    <div class="film-strip w-20 hidden md:block"></div>
                </div>
                <nav class="flex space-x-6">
                    <a href="{{ route('homepage') }}" class="font-bold glow-text text-yellow-400 hover:text-yellow-200">Home</a>
                    <a href="{{ route('movies.index') }}" class="font-bold glow-text text-yellow-400 hover:text-yellow-200">Movies</a>
                    <a href="{{ route('cinema') }}" class="font-bold glow-text text-yellow-400 hover:text-yellow-200">Cinemas</a>
                    <a href="{{ route('contact') }}" class="font-bold glow-text text-yellow-400 hover:text-yellow-200">Contact Us</a>

                    @if(auth()->user() == null)
                    <a href="{{ route('register') }}" class="font-bold glow-text text-yellow-400 hover:text-yellow-200">Sign Up</a>
                    <a href="{{ route('login') }}" class="font-bold glow-text text-yellow-400 hover:text-yellow-200">Log In</a>
                    @else
                    <span class="text-yellow-400">Hi, {{ auth()->user()->details->full_name }}</span>
                    @endif
                </nav>
            </div>
        </div>
    </header>
<div class="mt-20">   
@yield('content')
</div>
</html>
