@extends('main')
@section('content')

<section class="relative h-[800px] w-full mb-8 sm:mb-12 md:mb-16 lg:mb-20 xl:mb-24">
    <div class="relative z-10 flex flex-col justify-center h-full px-8 md:px-16 text-white max-w-3xl ml-64">
        <h1 class="text-7xl font-extrabold text-yellow-400 leading-tight mt-80"> SECURE YOUR PERFECT MOVIE EXPERIENCE</h1>

        <p class="mt-4 text-3xl text-gray-200 leading-tight font-[Poppins]">Browse movies, select seats, and book tickets in seconds. Your ultimate cinema booking platform for unforgettable movie moments.</p> 
        <button class="mt-6 bg-red-600 hover:bg-red-700 text-3xl text-white font-extrabold px-16 py-5 rounded-lg transition-colors w-fit" onclick="window.location.href='{{ url('/movies') }}'">BOOK NOW</button>
        
        @if(auth()->user() != null)
        @if(auth()->user()->type == '1')
        <button class="mt-6 bg-red-600 hover:bg-red-700 text-3xl text-white font-extrabold px-10 py-5 rounded-lg transition-colors w-fit" onclick="window.location.href='{{ url('/admin') }}'">ADMIN DASHBOARD</button>
        @endif
        @endif
        
    </div>
</section>

@endsection
