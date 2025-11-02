@extends('main')
@section('content')
    <div class="flex flex-wrap gap-2 p-5 ">
    @foreach($genres as $genre)
    <button class="filter-btn text-white font-semibold border-gray-700 px-3 py-1 rounded-lg" data-genre="{{ $genre['data_genre'] }}">{{ $genre['title'] }}</button>
    @endforeach
    </div>

        <div class="container px-6 py-8">
            <h2 class="text-3xl font-bold text-white mb-6 glow-text">Now Showing</h2>
        </div>
        
        <div class="container px-6 pb-8"> 
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($movies as $movie)
                    <a href="{{ route('schedule', $movie->id) }}" 
                    class="bg-gray-900 rounded-lg overflow-hidden shadow-lg 
                            transform transition duration-300 ease-in-out 
                            hover:scale-[1.03] hover:shadow-2xl"
                    data-genres="{{ strtolower($movie->genre) }}">

                        <img class="w-full h-64 object-cover" 
                            src="{{ asset('storage/' . $movie->poster) }}" 
                            alt="{{ $movie->title }}">
                        
                        <div class="p-4">
                            <h3 class="text-white text-lg font-semibold mb-2">{{ $movie->title }}</h3>
                            <div class="flex items-center text-gray-400 text-sm mb-3">
                                <span>{{ $movie->duration }}</span><span class="mx-2">|</span>{{ $movie->rating }}
                            </div>
                            <div class="flex flex-wrap gap-2 text-sm">
                                @foreach(explode(',', $movie->genre) as $g)
                                    <span class="px-3 py-1 bg-gray-700 text-gray-200 rounded-full">
                                        {{ trim($g) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>


<script>
document.addEventListener('DOMContentLoaded', () => {

  const genreButtons = document.querySelectorAll('.filter-btn');
  const movieCards = document.querySelectorAll('[data-genres]');

  const activeClasses = ['bg-red-600', 'hover:bg-red-700', 'font-semibold', 'text-white'];
  const inactiveClasses = ['bg-gray-800', 'font-semibold', 'hover:text-yellow-300', 'text-white'];

  function highlightButton(genre) {
    genreButtons.forEach(btn => {

      btn.classList.remove(...activeClasses);
      btn.classList.add(...inactiveClasses);

      if (btn.getAttribute('data-genre') === genre) {
        btn.classList.remove(...inactiveClasses);
        btn.classList.add(...activeClasses);
      }
    });
    }

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

    genreButtons.forEach(button => {
    button.addEventListener('click', () => {
      const selectedGenre = button.getAttribute('data-genre');
      highlightButton(selectedGenre);
      filterMovies(selectedGenre);
    });
    });

  highlightButton('all');
  filterMovies('all');
});
</script>
@endsection

