<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Cinematique') }}</title>
    </head>
    <link href="/css/style.css" rel="stylesheet">
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
                    <button class="font-bold glow-text text-white transition-colors" onclick="window.location.href='{{ url('/homepage') }}'">Home</button>
                    <button class="font-bold glow-text text-white transition-colors" onclick="showSection('trending')">Movies</button>
                    <button class="font-bold glow-text text-white transition-colors" onclick="showSection('genres')">Cinemas</button>
                    <button class="font-bold glow-text text-white transition-colors" onclick="showSection('trending')">Events</button>
                </nav>
            </div>
        </div>
    </header>

    <div class="flex flex-wrap gap-2 m-4">
    <button class="filter-btn bg-red-600 text-white font-semibold border-gray-700 px-3 py-1 rounded-lg" data-genre="all">All Movies</button>
    <button class="filter-btn bg-gray-900 text-white border-gray-700 px-3 py-1 rounded-lg" data-genre="action">Action</button>
    <button class="filter-btn bg-gray-900 text-white border-gray-700 px-3 py-1 rounded-lg" data-genre="sci-fi">Sci-Fi</button>
    <button class="filter-btn bg-gray-900 text-white border-gray-700 px-3 py-1 rounded-lg" data-genre="adventure">Adventure</button>
    <button class="filter-btn bg-gray-900 text-white border-gray-700 px-3 py-1 rounded-lg" data-genre="fantasy">Fantasy</button>
    <button class="filter-btn bg-gray-900 text-white border-gray-700 px-3 py-1 rounded-lg" data-genre="horror">Horror</button>
    <button class="filter-btn bg-gray-900 text-white border-gray-700 px-3 py-1 rounded-lg" data-genre="thriller">Thriller</button>
    <button class="filter-btn bg-gray-900 text-white border-gray-700 px-3 py-1 rounded-lg" data-genre="suspense">Suspense</button>
    </div>

        <div class="h-px bg-gray-700 mx-3"></div>

        <div class="container px-6 py-8">
            <h2 class="text-3xl font-bold text-white mb-6 glow-text">Now Showing</h2>
        </div>
        
        <div class="container px-6 pb-8"> 
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg 
                            transform transition duration-300 ease-in-out 
                            hover:scale-[1.03] hover:shadow-2xl" data-genres="action,sci-fi">
                    <img class="w-full h-64 object-cover" src="{{ asset('images/transformers.jpg') }}" alt="Transformers">
                    <div class="p-4">
                        <h3 class="text-white text-lg font-semibold mb-2">Transformers</h3>
                        <div class="flex items-center text-gray-400 text-sm mb-3">
                            <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span>7.3</span><span class="mx-2">|</span><span>144 min</span>
                        </div>
                        <div class="flex flex-wrap gap-2 text-sm">
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Action</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Sci-Fi</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg 
                            transform transition duration-300 ease-in-out 
                            hover:scale-[1.03] hover:shadow-2xl" data-genres="action,adventure,sci-fi">
                    <img class="w-full h-64 object-cover" src="{{ asset('images/avengers_endgame.jpg') }}" alt="Avengers: Endgame">
                    <div class="p-4">
                        <h3 class="text-white text-lg font-semibold mb-2">Avengers: Endgame</h3>
                        <div class="flex items-center text-gray-400 text-sm mb-3">
                            <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span>9.1</span><span class="mx-2">|</span><span>181 minutes</span>
                        </div>
                        <div class="flex flex-wrap gap-2 text-sm">
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Action</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Adventure</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Sci-Fi</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg 
                            transform transition duration-300 ease-in-out 
                            hover:scale-[1.03] hover:shadow-2xl" data-genres="horror,thriller">
                    <img class="w-full h-64 object-cover" src="{{ asset('images/conjuring.jpg') }}" alt="conjuring">
                    <div class="p-4">
                        <h3 class="text-white text-lg font-semibold mb-2">Conjuring</h3>
                        <div class="flex items-center text-gray-400 text-sm mb-3">
                            <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span>8.0</span><span class="mx-2">|</span><span>135 min</span>
                        </div>
                        <div class="flex flex-wrap gap-2 text-sm">
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Horror</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Thriller</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg 
                            transform transition duration-300 ease-in-out 
                            hover:scale-[1.03] hover:shadow-2xl" data-genres="action,adventure,fantasy,sci-fi">
                    <img class="w-full h-64 object-cover" src="{{ asset('images/spiderman.jpg') }}" alt="spiderman">
                    <div class="p-4">
                        <h3 class="text-white text-lg font-semibold mb-2">Spider-Man: No Way Home</h3>
                        <div class="flex items-center text-gray-400 text-sm mb-3">
                            <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span>8.9</span><span class="mx-2">|</span><span>148 min</span>
                        </div>
                        <div class="flex flex-wrap gap-2 text-sm">
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Action</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Adventure</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Fantasy</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Sci-Fi</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg 
                            transform transition duration-300 ease-in-out 
                            hover:scale-[1.03] hover:shadow-2xl" data-genres="action,adventure,Suspense,sci-fi,thriller">
                    <img class="w-full h-64 object-cover" src="{{ asset('images/jurrasic_world.jpg') }}" alt="jurrasic world">
                    <div class="p-4">
                        <h3 class="text-white text-lg font-semibold mb-2">Jurasic World: Rebirth</h3>
                        <div class="flex items-center text-gray-400 text-sm mb-3">
                            <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span>7.7</span><span class="mx-2">|</span><span>134 min</span>
                        </div>
                        <div class="flex flex-wrap gap-2 text-sm">
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Action</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Sci-Fi</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Adventure</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Suspense</span>
                            <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">Thriller</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Get all genre filter buttons and movie cards
    const genreButtons = document.querySelectorAll('.filter-btn');
    const movieCards = document.querySelectorAll('[data-genres]');

    // Tailwind-style classes
    const activeClasses = ['bg-red-600', 'hover:bg-red-700', 'border-gray-700'];
    const inactiveClasses = ['bg-gray-900', 'hover:text-yellow-500', 'hover:border-yellow-500', 'border-gray-700'];

    // Loop through all buttons
    genreButtons.forEach(button => {
        button.addEventListener('click', () => {
            const selectedGenre = button.getAttribute('data-genre');

            // Reset button styles
            genreButtons.forEach(btn => {
                btn.classList.remove(...activeClasses, 'font-semibold');
                btn.classList.add(...inactiveClasses, 'font-medium');
            });

            // Highlight the clicked button
            button.classList.remove(...inactiveClasses, 'font-medium');
            button.classList.add(...activeClasses, 'font-semibold');

            // Filter movies
            filterMovies(selectedGenre);
        });
    });

    // Filter logic
    function filterMovies(genre) {
        movieCards.forEach(card => {
            const cardGenres = card.getAttribute('data-genres');

            if (genre === 'all' || (cardGenres && cardGenres.toLowerCase().includes(genre.toLowerCase()))) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Initialize: show all movies
    filterMovies('all');
});
</script>

</body>
</html>
