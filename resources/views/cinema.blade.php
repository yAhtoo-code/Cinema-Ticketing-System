@extends('main')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-5xl text-white font-bold mb-6 glow-text">Cinema Branches</h1>
        <div class="cinema-branches-container p-6 mx-auto max-w-[1600px]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="branch-card bg-gray-900 text-white rounded-lg p-5 shadow-lg border border-gray-700">
                <h3 class="text-xl font-bold text-red-500 mb-2">SM Megamall Cinemas</h3>
                <p class="text-sm text-gray-400 mb-3">📍 EDSA, Mandaluyong City</p>
                <p class="mb-1">4 Regular Cinemas, 2 Director's Clubs, IMAX</p>
                <p class="text-xs text-yellow-400">Current Promos: Wednesday Movie Madness</p>
            </div>

            <div class="branch-card bg-gray-900 text-white rounded-lg p-5 shadow-lg border border-gray-700">
                <h3 class="text-xl font-bold text-red-500 mb-2">Ayala Malls Manila Bay</h3>
                <p class="text-sm text-gray-400 mb-3">📍 Aseana Ave., Paranaque City</p>
                <p class="mb-1">8 Standard Cinemas, 1 A-Giant Screen</p>
                <p class="text-xs text-yellow-400">Amenities: Full Recliner Seats</p>
            </div>

            <div class="branch-card bg-gray-900 text-white rounded-lg p-5 shadow-lg border border-gray-700">
                <h3 class="text-xl font-bold text-red-500 mb-2">Robinsons Galleria Cebu</h3>
                <p class="text-sm text-gray-400 mb-3">📍 Gen. Maxilom Ave. Ext., Cebu City</p>
                <p class="mb-1">6 Standard Theatres, Dolby Atmos Ready</p>
                <p class="text-xs text-yellow-400">Great for Visayas moviegoers!</p>
            </div>

            <div class="branch-card bg-gray-900 text-white rounded-lg p-5 shadow-lg border border-gray-700">
                <h3 class="text-xl font-bold text-red-500 mb-2">Trinoma Cinema</h3>
                <p class="text-sm text-gray-400 mb-3">📍 EDSA cor. North Ave., Quezon City</p>
                <p class="mb-1">8 Standard Cinemas</p>
                <p class="text-xs text-yellow-400">Easy access via MRT North Ave.</p>
            </div>
            
            </div>
        </div>

    </div>
@endsection