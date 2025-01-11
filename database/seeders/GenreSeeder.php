<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::insert([
            ['nom' => 'Action'],
            ['nom' => 'Comédie'],
            ['nom' => 'Drame'],
            ['nom' => 'Romance'],
            ['nom' => 'triller'],
            ['nom' => 'animation'],
            ['nom' => 'adventure'],
        ]);
    }
}
