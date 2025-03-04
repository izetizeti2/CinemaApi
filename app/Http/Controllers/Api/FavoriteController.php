<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    // Metoda për të shtuar një film në preferenca
    public function addToFavorites(Request $request, $movie_id)
{
    $user = Auth::user(); // Përdoruesi aktual i kyçur
    
    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401); // Kontrollo nëse përdoruesi është i kyçur
    }

    // Kontrollo nëse filmi ekziston
    $movie = Movie::find($movie_id);
    if (!$movie) {
        return response()->json(['message' => 'Movie not found'], 404);
    }

    // Verifikojmë nëse filmi është shtuar tashmë në preferenca
    $existingFavorite = Favorite::where('user_id', $user->id)
                                ->where('movie_id', $movie_id)
                                ->first();

    if ($existingFavorite) {
        return response()->json(['message' => 'Movie already in favorites'], 400);
    }

    // Shto filmin në preferenca
    $favorite = Favorite::create([
        'user_id' => $user->id,
        'movie_id' => $movie_id
    ]);

    return response()->json(['message' => 'Movie added to favorites']);
}


    // Metoda për të marrë të gjithë filmat në preferencat e përdoruesit
    public function getFavorites(Request $request)
    {
        $user = Auth::user(); // Përdoruesi aktual i kyçur

        // Merr të gjithë filmat që përdoruesi ka shtuar në preferenca
        $favorites = $user->favorites()->with('movie')->get();

        return response()->json($favorites);
    }

    // Metoda për të hequr një film nga preferencat
    public function removeFromFavorites(Request $request, $movie_id)
    {
        $user = Auth::user(); // Përdoruesi aktual i kyçur

        // Gjejmë regjistrimin e preferencës
        $favorite = Favorite::where('user_id', $user->id)
                            ->where('movie_id', $movie_id)
                            ->first();

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        // Heqim filmin nga preferencat
        $favorite->delete();

        return response()->json(['message' => 'Movie removed from favorites']);
    }
}
