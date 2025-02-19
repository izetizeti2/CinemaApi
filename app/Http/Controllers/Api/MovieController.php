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
        // Gjejmë filmin në bazën e të dhënave
        $movie = Movie::find($id);
    
        // Kontrollo nëse filmi ekziston
        if (!$movie) {
            return Response::json(['message' => 'Movie not found'], 404);
        }
    
        // Validimi i të dhënave
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'director' => 'required|string|max:255',
            'release_date' => 'required|date',
            'synopsis' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Lejo ngarkimin e posterëve
        ]);
    
        // Nëse validimi dështon
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 400);
        }
    
        // Përditësojmë detajet e filmit
        $movie->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'director' => $request->director,
            'release_date' => $request->release_date,
            'synopsis' => $request->synopsis,
        ]);
    
        // Kontrollojmë nëse përdoruesi ka ngarkuar një poster të ri
        if ($request->hasFile('poster')) {
            // Ruajmë posterin e ri
            $posterPath = $request->file('poster')->store('posters', 'public'); 
            
            // Krijojmë URL për posterin e ri
            $posterUrl = asset("storage/{$posterPath}");
    
            // Përditësojmë fushën 'poster' të filmit me rrugën e re të posterit
            $movie->poster = $posterPath;
    
            // Përsëri ruajmë filmin me posterin e ri
            $movie->save();
        }
    
        // Kthejmë përgjigjen me detajet e filmit të përditësuar
        return Response::json([
            'message' => 'Movie updated successfully',
            'movie' => $movie
        ], 200);
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
