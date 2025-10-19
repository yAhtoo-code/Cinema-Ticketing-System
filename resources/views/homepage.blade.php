@extends('main')
@section('content')

<section class="relative h-[800px] w-full">
    <div class="relative z-10 flex flex-col justify-center h-full px-8 md:px-16 text-white max-w-3xl">
        <h1 class="text-4xl md:text-5xl font-extrabold text-yellow-400 leading-tight">
        SECURE YOUR PERFECT MOVIE EXPERIENCE
        </h1>
        <p class="mt-4 text-lg text-gray-200 font-[Poppins]">Browse movies, select seats, and book tickets in</p> 
        <p class="text-lg text-gray-200 font-[Poppins]">seconds. Your ultimate cinema booking platform </p> 
        <p class="text-lg text-gray-200 font-[Poppins]">for unforgettable movie moments.</p> 
        
        <button class="mt-6 bg-red-600 hover:bg-red-700 text-white font-extrabold px-6 py-3 rounded-lg transition-colors w-fit" onclick="window.location.href='{{ url('/movies') }}'">BOOK NOW</button>
    </div>
</section>

@endsection
