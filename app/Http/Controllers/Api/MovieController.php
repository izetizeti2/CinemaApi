<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    // Merr të gjitha filmat
    public function index()
    {
        $movies = Movie::with('category')->get();
    
        // Append full poster URL to each movie
        $movies->transform(function ($movie) {
            $movie->poster_url = $movie->poster ? asset("storage/{$movie->poster}") : null;
            return $movie;
        });
    
        return Response::json($movies);
    }
    
    public function show($id)
    {
        $movie = Movie::with('category')->find($id);
    
        if (!$movie) {
            return Response::json(['message' => 'Movie not found'], 404);
        }
    
        $movie->poster_url = $movie->poster ? asset("storage/{$movie->poster}") : null;
    
        return Response::json($movie);
    }
    

    // Krijo një film të ri
    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'director' => 'required|string|max:255',
            'release_date' => 'required|date',
            'synopsis' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
        ]);
    
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 400);
        }
    
        // Handle image upload
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $posterUrl = asset("storage/{$posterPath}"); // Generate full URL for frontend
        } else {
            $posterUrl = null;
        }
    
        // Create a new movie
        $movie = Movie::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'director' => $request->director,
            'release_date' => $request->release_date,
            'synopsis' => $request->synopsis,
            'poster' => $posterPath ?? null, // Store relative path in DB
        ]);
    
        // Return movie with full poster URL
        return Response::json([
            'movie' => $movie,
            'poster_url' => $posterUrl // Send full image URL
        ], 201);
    }    

    // Përditëso një film ekzistues

public function update(Request $request, $id)
{
    $movie = Movie::find($id);

    if (!$movie) {
        return Response::json(['message' => 'Movie not found'], 404);
    }

    // Validate data
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'director' => 'required|string|max:255',
        'release_date' => 'required|date',
        'synopsis' => 'required|string',
        'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Allow image file upload
    ]);

    if ($validator->fails()) {
        return Response::json(['errors' => $validator->errors()], 400);
    }

    // Update movie details
    $movie->update([
        'title' => $request->title,
        'category_id' => $request->category_id,
        'director' => $request->director,
        'release_date' => $request->release_date,
        'synopsis' => $request->synopsis,
    ]);

    // Handle poster file upload (save it the same way as in store)
    if ($request->hasFile('poster')) {
        // Delete the old poster file if it exists
        if ($movie->poster && Storage::exists("public/{$movie->poster}")) {
            Storage::delete("public/{$movie->poster}");
        }

        // Store the new poster
        $posterPath = $request->file('poster')->store('posters', 'public');
        $movie->update(['poster' => $posterPath]);
    }

    // Return updated movie with full poster URL
    return Response::json([
        'movie' => $movie,
        'poster_url' => $movie->poster ? asset("storage/{$movie->poster}") : null
    ]);
}



    // Fshi një film
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return Response::json(['message' => 'Movie not found'], 404);
        }

        $movie->delete();
        return Response::json(['message' => 'Movie deleted successfully'], 200);
    }
}
