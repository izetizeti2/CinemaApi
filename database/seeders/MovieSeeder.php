<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Category;

class MovieSeeder extends Seeder
{
    public function run()
    {
        // Përdor kategoritë ekzistuese dhe krijo filmat

        $actionCategory = Category::firstOrCreate(['name' => 'Action']);
        Movie::create([
            'title' => 'Mad Max: Fury Road',
            'category_id' => $actionCategory->id,
            'director' => 'George Miller',
            'release_date' => '2015-05-15',
            'synopsis' => 'In a post-apocalyptic wasteland, Max teams up with a runaway to escape a tyrannical warlord.',
            'poster' => 'storage/posters/mad_max_fury_road.jpg' 
        ]);
        Movie::create([
            'title' => 'Action Movie 2',
            'category_id' => $actionCategory->id,
            'director' => 'Director Action',
            'release_date' => '2025-02-01',
            'synopsis' => 'Synopsis for Action Movie 2',
            'poster' => 'storage/posters/action_movie_2.jpg'
        ]);

        $adventureCategory = Category::firstOrCreate(['name' => 'Adventure']);
        Movie::create([
            'title' => 'The Lord of the Rings: The Fellowship of the Ring',
            'category_id' => $adventureCategory->id,
            'director' => 'Peter Jackson',
            'release_date' => '2001-12-19',
            'synopsis' => 'A young hobbit embarks on a dangerous journey to destroy a powerful ring.',
            'poster' => 'storage/posters/lord_of_the_rings.jpg'
        ]);
        Movie::create([
            'title' => 'Adventure Movie 2',
            'category_id' => $adventureCategory->id,
            'director' => 'Director Adventure',
            'release_date' => '2025-02-01',
            'synopsis' => 'Synopsis for Adventure Movie 2',
            'poster' => 'posters/adventure_movie_2.jpg'
        ]);

        $comedyCategory = Category::firstOrCreate(['name' => 'Comedy']);
        Movie::create([
            'title' => 'The Hangover',
            'category_id' => $comedyCategory->id,
            'director' => 'Todd Phillips',
            'release_date' => '2009-06-05',
            'synopsis' => 'A bachelor party in Las Vegas turns into a wild adventure when the groom goes missing.',
            'poster' => 'posters/the_hangover.jpg'
        ]);
        Movie::create([
            'title' => 'Comedy Movie 2',
            'category_id' => $comedyCategory->id,
            'director' => 'Director Comedy',
            'release_date' => '2025-02-01',
            'synopsis' => 'Synopsis for Comedy Movie 2',
            'poster' => 'posters/comedy_movie_2.jpg'
        ]);

        $documentaryCategory = Category::firstOrCreate(['name' => 'Documentary']);
        Movie::create([
            'title' => 'Won’t You Be My Neighbor?',
            'category_id' => $documentaryCategory->id,
            'director' => 'Morgan Neville',
            'release_date' => '2018-06-08',
            'synopsis' => 'A documentary about the life and career of Fred Rogers, host of the popular children\'s TV show.',
            'poster' => 'posters/wont_you_be_my_neighbor.jpg'
        ]);
        Movie::create([
            'title' => 'Documentary Movie 2',
            'category_id' => $documentaryCategory->id,
            'director' => 'Director Documentary',
            'release_date' => '2025-02-01',
            'synopsis' => 'Synopsis for Documentary Movie 2',
            'poster' => 'posters/documentary_movie_2.jpg'
        ]);

        $dramaCategory = Category::firstOrCreate(['name' => 'Drama']);
        Movie::create([
            'title' => 'The Shawshank Redemption',
            'category_id' => $dramaCategory->id,
            'director' => 'Frank Darabont',
            'release_date' => '1994-09-22',
            'synopsis' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
            'poster' => 'posters/shawshank_redemption.jpg'
        ]);
        Movie::create([
            'title' => 'Drama Movie 2',
            'category_id' => $dramaCategory->id,
            'director' => 'Director Drama',
            'release_date' => '2025-02-01',
            'synopsis' => 'Synopsis for Drama Movie 2',
            'poster' => 'posters/drama_movie_2.jpg'
        ]);

        // Mund të shtoni edhe kategoritë e tjera në të njëjtën mënyrë
    }
}
