<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Cinematique') }}</title>
    </head>
    <body>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .movie-card {
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #1f2937, #374151);
        }
        
        .movie-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        
        .genre-badge {
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            animation: pulse 2s infinite;
        }
        
        .hero-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.03"/><circle cx="50" cy="10" r="0.5" fill="%23ffffff" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .spotlight {
            background: radial-gradient(circle at center, rgba(59, 130, 246, 0.3) 0%, transparent 70%);
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            pointer-events: none;
            animation: spotlight 8s linear infinite;
        }
        
        @keyframes spotlight {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        
        .film-strip {
            background: repeating-linear-gradient(
                90deg,
                #374151 0px,
                #374151 20px,
                #1f2937 20px,
                #1f2937 40px
            );
            height: 8px;
        }
        
        .glow-text {
            text-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }
        
        .rating-stars {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <!-- Header -->
    <header class="bg-black/50 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="text-3xl font-bold glow-text">Cinematique</div>
                    <div class="film-strip w-20 hidden md:block"></div>
                </div>
                <nav class="flex space-x-6">
                    <button class="hover:text-blue-400 transition-colors" onclick="showSection('home')">Home</button>
                    <button class="hover:text-blue-400 transition-colors" onclick="showSection('genres')">Genres</button>
                    <button class="hover:text-blue-400 transition-colors" onclick="showSection('trending')">Trending</button>
                    <button class="hover:text-blue-400 transition-colors" onclick="showSection('awards')">Awards</button>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero-bg min-h-screen flex items-center justify-center relative">
        <div class="spotlight top-1/4 left-1/4"></div>
        <div class="spotlight top-3/4 right-1/4" style="animation-delay: -4s;"></div>
        
        <div class="text-center z-10 max-w-4xl mx-auto px-6">
            <h1 class="text-7xl font-bold mb-6 glow-text floating-animation">
                Welcome to Home Page
            </h1>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Discover the magic of movies - from Hollywood blockbusters to indie masterpieces, 
                explore the world of cinema like never before.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <button class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-4 rounded-full font-semibold hover:scale-105 transform transition-all duration-300 shadow-lg hover:shadow-blue-500/25" onclick="showSection('genres')">
                    Explore Genres
                </button>
                <button class="border-2 border-white/30 px-8 py-4 rounded-full font-semibold hover:bg-white/10 transition-all duration-300" onclick="showSection('trending')">
                    What's Trending
                </button>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 text-4xl floating-animation" style="animation-delay: -1s;">🎭</div>
        <div class="absolute bottom-20 right-10 text-4xl floating-animation" style="animation-delay: -3s;">🍿</div>
        <div class="absolute top-1/2 left-5 text-3xl floating-animation" style="animation-delay: -2s;">🎪</div>
    </section>

    <!-- Genres Section -->
    <section id="genres" class="py-20 bg-gray-800/50 hidden">
        <div class="container mx-auto px-6">
            <h2 class="text-5xl font-bold text-center mb-16 glow-text">Movie Genres</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div class="genre-card bg-gradient-to-br from-red-600 to-red-800 p-6 rounded-xl hover:scale-105 transition-transform cursor-pointer" onclick="showGenreMovies('Action')">
                    <div class="text-4xl mb-4">💥</div>
                    <h3 class="text-2xl font-bold mb-2">Action</h3>
                    <p class="text-red-100">High-octane thrills and explosive adventures</p>
                </div>
                <div class="genre-card bg-gradient-to-br from-yellow-600 to-yellow-800 p-6 rounded-xl hover:scale-105 transition-transform cursor-pointer" onclick="showGenreMovies('Comedy')">
                    <div class="text-4xl mb-4">😂</div>
                    <h3 class="text-2xl font-bold mb-2">Comedy</h3>
                    <p class="text-yellow-100">Laughter and feel-good moments</p>
                </div>
                <div class="genre-card bg-gradient-to-br from-blue-600 to-blue-800 p-6 rounded-xl hover:scale-105 transition-transform cursor-pointer" onclick="showGenreMovies('Drama')">
                    <div class="text-4xl mb-4">🎭</div>
                    <h3 class="text-2xl font-bold mb-2">Drama</h3>
                    <p class="text-blue-100">Emotional storytelling and character depth</p>
                </div>
                <div class="genre-card bg-gradient-to-br from-purple-600 to-purple-800 p-6 rounded-xl hover:scale-105 transition-transform cursor-pointer" onclick="showGenreMovies('Sci-Fi')">
                    <div class="text-4xl mb-4">🚀</div>
                    <h3 class="text-2xl font-bold mb-2">Sci-Fi</h3>
                    <p class="text-purple-100">Future worlds and technological wonders</p>
                </div>
                <div class="genre-card bg-gradient-to-br from-green-600 to-green-800 p-6 rounded-xl hover:scale-105 transition-transform cursor-pointer" onclick="showGenreMovies('Horror')">
                    <div class="text-4xl mb-4">👻</div>
                    <h3 class="text-2xl font-bold mb-2">Horror</h3>
                    <p class="text-green-100">Spine-chilling scares and supernatural tales</p>
                </div>
                <div class="genre-card bg-gradient-to-br from-pink-600 to-pink-800 p-6 rounded-xl hover:scale-105 transition-transform cursor-pointer" onclick="showGenreMovies('Romance')">
                    <div class="text-4xl mb-4">💕</div>
                    <h3 class="text-2xl font-bold mb-2">Romance</h3>
                    <p class="text-pink-100">Love stories that touch the heart</p>
                </div>
                <div class="genre-card bg-gradient-to-br from-indigo-600 to-indigo-800 p-6 rounded-xl hover:scale-105 transition-transform cursor-pointer" onclick="showGenreMovies('Animation')">
                    <div class="text-4xl mb-4">🎨</div>
                    <h3 class="text-2xl font-bold mb-2">Animation</h3>
                    <p class="text-indigo-100">Artistic storytelling through animation</p>
                </div>
                <div class="genre-card bg-gradient-to-br from-gray-600 to-gray-800 p-6 rounded-xl hover:scale-105 transition-transform cursor-pointer" onclick="showGenreMovies('Documentary')">
                    <div class="text-4xl mb-4">📽️</div>
                    <h3 class="text-2xl font-bold mb-2">Documentary</h3>
                    <p class="text-gray-100">Real stories and factual narratives</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trending Movies Section -->
    <section id="trending" class="py-20 bg-gray-900 hidden">
        <div class="container mx-auto px-6">
            <h2 class="text-5xl font-bold text-center mb-16 glow-text">Trending Now</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="movie-card rounded-xl p-6 hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 h-64 rounded-lg mb-4 flex items-center justify-center text-6xl">🦸‍♂️</div>
                    <h3 class="text-2xl font-bold mb-2">Superhero Epic</h3>
                    <div class="flex items-center mb-2">
                        <span class="rating-stars text-lg">★★★★★</span>
                        <span class="ml-2 text-gray-400">9.2/10</span>
                    </div>
                    <p class="text-gray-300 mb-4">A groundbreaking superhero adventure that redefines the genre.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="genre-badge text-xs px-3 py-1 rounded-full">Action</span>
                        <span class="genre-badge text-xs px-3 py-1 rounded-full">Adventure</span>
                    </div>
                </div>
                
                <div class="movie-card rounded-xl p-6 hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-br from-green-500 to-teal-600 h-64 rounded-lg mb-4 flex items-center justify-center text-6xl">🌌</div>
                    <h3 class="text-2xl font-bold mb-2">Cosmic Journey</h3>
                    <div class="flex items-center mb-2">
                        <span class="rating-stars text-lg">★★★★☆</span>
                        <span class="ml-2 text-gray-400">8.7/10</span>
                    </div>
                    <p class="text-gray-300 mb-4">An interstellar adventure that explores the vastness of space.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="genre-badge text-xs px-3 py-1 rounded-full">Sci-Fi</span>
                        <span class="genre-badge text-xs px-3 py-1 rounded-full">Drama</span>
                    </div>
                </div>
                
                <div class="movie-card rounded-xl p-6 hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-br from-red-500 to-orange-600 h-64 rounded-lg mb-4 flex items-center justify-center text-6xl">🎭</div>
                    <h3 class="text-2xl font-bold mb-2">The Artist's Tale</h3>
                    <div class="flex items-center mb-2">
                        <span class="rating-stars text-lg">★★★★★</span>
                        <span class="ml-2 text-gray-400">9.5/10</span>
                    </div>
                    <p class="text-gray-300 mb-4">A deeply moving drama about passion, sacrifice, and art.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="genre-badge text-xs px-3 py-1 rounded-full">Drama</span>
                        <span class="genre-badge text-xs px-3 py-1 rounded-full">Biography</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Awards Section -->
    <section id="awards" class="py-20 bg-gradient-to-br from-yellow-900/20 to-yellow-800/20 hidden">
        <div class="container mx-auto px-6">
            <h2 class="text-5xl font-bold text-center mb-16 glow-text">Award Winners</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="text-center">
                    <div class="text-8xl mb-6">🏆</div>
                    <h3 class="text-3xl font-bold mb-4 text-yellow-400">Best Picture Winners</h3>
                    <div class="space-y-4">
                        <div class="bg-black/30 p-4 rounded-lg">
                            <h4 class="text-xl font-semibold">2024: Oppenheimer</h4>
                            <p class="text-gray-300">Christopher Nolan's biographical thriller</p>
                        </div>
                        <div class="bg-black/30 p-4 rounded-lg">
                            <h4 class="text-xl font-semibold">2023: Everything Everywhere All at Once</h4>
                            <p class="text-gray-300">Mind-bending multiverse adventure</p>
                        </div>
                        <div class="bg-black/30 p-4 rounded-lg">
                            <h4 class="text-xl font-semibold">2022: CODA</h4>
                            <p class="text-gray-300">Coming-of-age deaf family drama</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <div class="text-8xl mb-6">🎭</div>
                    <h3 class="text-3xl font-bold mb-4 text-yellow-400">International Recognition</h3>
                    <div class="space-y-4">
                        <div class="bg-black/30 p-4 rounded-lg">
                            <h4 class="text-xl font-semibold">Palme d'Or 2024</h4>
                            <p class="text-gray-300">Cannes Film Festival's highest honor</p>
                        </div>
                        <div class="bg-black/30 p-4 rounded-lg">
                            <h4 class="text-xl font-semibold">BAFTA Winners</h4>
                            <p class="text-gray-300">British Academy's finest selections</p>
                        </div>
                        <div class="bg-black/30 p-4 rounded-lg">
                            <h4 class="text-xl font-semibold">Golden Globe Champions</h4>
                            <p class="text-gray-300">Hollywood Foreign Press favorites</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Movie Details Modal -->
    <div id="movieModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-6">
        <div class="bg-gray-800 rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <h3 id="modalTitle" class="text-3xl font-bold glow-text">Movie Title</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-white text-2xl">&times;</button>
                </div>
                <div id="modalContent" class="space-y-4">
                    <!-- Content will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black py-12">
        <div class="container mx-auto px-6 text-center">
            <div class="film-strip w-full mb-6"></div>
            <p class="text-gray-400">© 2025 Cinema Explorer. Celebrating the magic of movies worldwide.</p>
            <div class="mt-4 text-2xl space-x-4">
                🎬 🍿 🎭 🎪 📽️
            </div>
        </div>
    </footer>

    <script>
        const movieData = {
            'Action': [
                { title: 'Thunder Strike', rating: 9.1, description: 'High-octane action with incredible stunts' },
                { title: 'Speed Force', rating: 8.7, description: 'Fast cars and faster thrills' },
                { title: 'Iron Will', rating: 9.3, description: 'A hero\'s journey against impossible odds' }
            ],
            'Comedy': [
                { title: 'Laugh Track', rating: 8.5, description: 'Comedy gold that will leave you in stitches' },
                { title: 'The Funny Bone', rating: 8.9, description: 'Smart humor meets heartfelt moments' },
                { title: 'Giggle Quest', rating: 8.2, description: 'Adventure comedy for the whole family' }
            ],
            'Drama': [
                { title: 'Tears of Joy', rating: 9.4, description: 'An emotional masterpiece about human resilience' },
                { title: 'The Last Stand', rating: 9.1, description: 'Powerful performances in this gripping drama' },
                { title: 'Broken Dreams', rating: 8.8, description: 'A haunting tale of loss and redemption' }
            ],
            'Sci-Fi': [
                { title: 'Beyond Tomorrow', rating: 9.0, description: 'Mind-bending sci-fi that questions reality' },
                { title: 'Star Bound', rating: 8.6, description: 'Epic space opera with stunning visuals' },
                { title: 'Time\'s Echo', rating: 9.2, description: 'Time travel done right with emotional depth' }
            ],
            'Horror': [
                { title: 'Midnight Terror', rating: 8.3, description: 'Psychological horror that haunts your dreams' },
                { title: 'The Dark Hour', rating: 8.7, description: 'Supernatural thriller with genuine scares' },
                { title: 'Whispers', rating: 8.1, description: 'Atmospheric horror with unexpected twists' }
            ],
            'Romance': [
                { title: 'Love\'s Promise', rating: 8.9, description: 'A timeless love story that touches hearts' },
                { title: 'Summer Rain', rating: 8.4, description: 'Romance blooms in unexpected places' },
                { title: 'Forever Yours', rating: 8.6, description: 'Epic romance spanning decades' }
            ],
            'Animation': [
                { title: 'Dreamland Adventures', rating: 9.3, description: 'Stunning animation with universal themes' },
                { title: 'Color Symphony', rating: 8.8, description: 'Visual masterpiece with emotional storytelling' },
                { title: 'Magic Kingdom', rating: 9.0, description: 'Enchanting tale for all ages' }
            ],
            'Documentary': [
                { title: 'Truth Revealed', rating: 8.7, description: 'Eye-opening investigation into important issues' },
                { title: 'Nature\'s Wonders', rating: 9.1, description: 'Breathtaking exploration of our planet' },
                { title: 'Human Stories', rating: 8.9, description: 'Inspiring tales of ordinary people doing extraordinary things' }
            ]
        };

        function showSection(sectionId) {
            // Hide all sections
            const sections = ['home', 'genres', 'trending', 'awards'];
            sections.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.classList.add('hidden');
                }
            });
            
            // Show selected section
            const targetSection = document.getElementById(sectionId);
            if (targetSection) {
                targetSection.classList.remove('hidden');
            }
        }

        function showGenreMovies(genre) {
            const movies = movieData[genre] || [];
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            
            modalTitle.textContent = `${genre} Movies`;
            
            modalContent.innerHTML = movies.map(movie => `
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h4 class="text-xl font-semibold mb-2">${movie.title}</h4>
                    <div class="flex items-center mb-2">
                        <span class="rating-stars text-lg">★★★★★</span>
                        <span class="ml-2 text-gray-400">${movie.rating}/10</span>
                    </div>
                    <p class="text-gray-300">${movie.description}</p>
                </div>
            `).join('');
            
            document.getElementById('movieModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('movieModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('movieModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Add some interactive sparkle effects
        function createSparkle() {
            const sparkle = document.createElement('div');
            sparkle.style.position = 'fixed';
            sparkle.style.pointerEvents = 'none';
            sparkle.style.color = '#3b82f6';
            sparkle.style.fontSize = '20px';
            sparkle.style.zIndex = '1000';
            sparkle.textContent = '✨';
            sparkle.style.left = Math.random() * window.innerWidth + 'px';
            sparkle.style.top = Math.random() * window.innerHeight + 'px';
            sparkle.style.animation = 'float 3s ease-out forwards';
            
            document.body.appendChild(sparkle);
            
            setTimeout(() => {
                sparkle.remove();
            }, 3000);
        }

        // Create sparkles periodically
        setInterval(createSparkle, 2000);

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>

    </body>
    </html>
