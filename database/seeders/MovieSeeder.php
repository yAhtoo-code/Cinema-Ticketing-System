<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Transformers',
                'rating' => 'PG-13',
                'duration' => '144 minutes',
                'genre' => 'Action, Sci-Fi',
                'synopsis' => "Four years after the Chicago battle, the government is hunting down all Transformers. Cade Yeager, a Texas mechanic, buys an old truck and discovers it's Optimus Prime, forcing him into a new war against a powerful enemy faction and a nefarious government agency.",
                'poster' => 'transformers.jpg',
            ],
            [
                'title' => 'Avengers: Endgame',
                'rating' => 'PG',
                'duration' => '181 minutes',
                'genre' => 'Action, Adventure, Sci-Fi',
                'synopsis' => "The fourth installment in the Avengers saga is the culmination of 22 interconnected Marvel films and the climax of a journey. The world's heroes finally understand just how fragile reality is, and the sacrifices that must be made to uphold it, in a story of friendship, teamwork and setting aside differences to overcome an impossible obstacle.",
                'poster' => 'avengers_endgame.jpg',
            ],
            [
                'title' => 'Conjuring',
                'rating' => 'R-16',
                'duration' => '135 minutes',
                'genre' => 'Horror, Thriller',
                'synopsis' => "In 1970, paranormal investigators and demonologists Lorraine (Vera Farmiga) and Ed (Patrick Wilson) Warren are summoned to the home of Carolyn (Lili Taylor) and Roger (Ron Livingston) Perron. The Perrons and their five daughters have recently moved into a secluded farmhouse, where a supernatural presence has made itself known. Though the manifestations are relatively benign at first, events soon escalate in horrifying fashion, especially after the Warrens discover the house's macabre history.",
                'poster' => 'conjuring.jpg',
            ],
            [
                'title' => 'Spider-Man: No Way Home',
                'rating' => 'PG-13',
                'duration' => '148 minutes',
                'genre' => 'Action, Adventure, Fantasy, Sci-Fi',
                'synopsis' => "With Spider-Man's identity now revealed, our friendly neighborhood web-slinger is unmasked and no longer able to separate his normal life as Peter Parker from the high stakes of being a superhero. When Peter asks for help from Doctor Strange, the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man.",
                'poster' => 'spiderman.jpg',
            ],
            [
                'title' => 'Jurasic World: Rebirth',
                'rating' => 'PG',
                'duration' => '134 minutes',
                'genre' => 'Action, Sci-Fi, Adventure, Suspense, Thriller',
                'synopsis' => "Zora Bennett leads a team of skilled operatives to the most dangerous place on Earth, an island research facility for the original Jurassic Park. Their mission is to secure genetic material from dinosaurs whose DNA can provide life-saving benefits to mankind. As the top-secret expedition becomes more and more risky, they soon make a sinister, shocking discovery that's been hidden from the world for decades.",
                'poster' => 'jurrasic_world.jpg',
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
