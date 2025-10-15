<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'name' => 'Action',
            'description' => 'A genre characterized by physical exertion and adventurous activities.',
        ]);
        Genre::create([
            'name' => 'Romance',
            'description' => 'A genre focused on romantic relationships between characters.',
        ]);
        Genre::create([
            'name' => 'Fantasy',
            'description' => 'A genre that uses magic and other supernatural elements as a primary plot element, theme, or setting.',
        ]);
        Genre::create([
            'name' => 'Horror',
            'description' => 'A genre intended to scare, unsettle, or horrify the audience.',
        ]);
        Genre::create([
            'name' => 'Comedy',
            'description' => 'A genre that aims to entertain and amuse the audience through humor.',
        ]);
    }
}
