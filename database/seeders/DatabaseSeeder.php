<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\MovieSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Thirrja e CategorySeeder për të krijuar kategoritë
        $this->call(CategorySeeder::class);

        // Thirrja e MovieSeeder për të krijuar filmat
        $this->call(MovieSeeder::class);

        $this->call(UserSeeder::class);

    }
}
