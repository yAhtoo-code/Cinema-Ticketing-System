<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = [
            ['title'=> 'All Movies', 'data_genre' => 'all'],
            ['title'=> 'Action', 'data_genre' => 'action'],
            ['title'=> 'Adventure', 'data_genre' => 'adventure'],
            ['title'=> 'Horror', 'data_genre' => 'horror'],
            ['title'=> 'Thriller', 'data_genre' => 'thriller'],
            ['title'=> 'Fantasy', 'data_genre' => 'fantasy'],
            ['title'=> 'Suspense', 'data_genre' => 'suspense'],
            ['title'=> 'Sci-Fi', 'data_genre' => 'sci-fi'],
        ];

        // Fetch all movies from the database
        $movies = Movie::all();

        // Pass both $genres and $movies to the Blade view
        return view('movies', compact('genres', 'movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('schedule', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        dd($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
