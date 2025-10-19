<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Cinematique') }}</title>
    </head>
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> 

<body class="relative"> 
<div class="absolute inset-0 bg-black/70 z-0"></div> 
<div class="relative z-10">

    <header>
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
               <img class="logo" src= "{{ asset('images/logo.png') }}" alt="Cinematique Logo">
                    <div class="film-strip w-20 hidden md:block"></div>
                </div>
                <nav class="flex space-x-6">
                    <button class="font-bold glow-text" onclick="window.location.href='{{ url('/') }}'">Home</button>
                    <button class="font-bold glow-text" onclick="window.location.href='{{ url('/movies') }}'"> Movies</button>
                    <button class="font-bold glow-text" onclick="window.location.href='{{ url('/cinema') }}'">Cinemas</button>
                </nav>
            </div>
        </div>
    </header>
<div class="mt-20">   
@yield('content')
</div>
</html>
