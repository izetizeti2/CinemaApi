<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Action',
            'Adventure',
            'Comedy',
            'Documentary',
            'Drama',
            'Fantasy',
            'Historical',
            'Horror'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
            echo "Category {$category} created.\n"; // Shto mesazh për debugging
        }
    }
}
