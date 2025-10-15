<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'The Great Adventure',
            'description' => 'An epic tale of adventure and discovery.',
            'price' => 50000,
            'stock' => 100,
            'cover_photo' => 'great_adventure.jpg',
            'genre_id' => 1, 
            'author_id' => 1, 
        ]);
        Book::create([
            'title' => 'Love in the Time of Cholera',
            'description' => 'A romantic novel set in a time of turmoil.',
            'price' => 60000,
            'stock' => 50,
            'cover_photo' => 'love_cholera.jpg',
            'genre_id' => 2, 
            'author_id' => 2, 
        ]);
        Book::create([
            'title' => 'The Enchanted Forest',
            'description' => 'A fantasy novel filled with magic and wonder.',
            'price' => 75000,
            'stock' => 75,
            'cover_photo' => 'enchanted_forest.jpg',
            'genre_id' => 3, 
            'author_id' => 3, 
        ]);
        Book::create([
            'title' => 'Mystery of the Old Mansion',
            'description' => 'A thrilling mystery novel set in an old mansion.',
            'price' => 55000,
            'stock' => 60,
            'cover_photo' => 'old_mansion.jpg',
            'genre_id' => 1, 
            'author_id' => 4, 
        ]);
        Book::create([
            'title' => 'Journey to the Stars',
            'description' => 'A science fiction novel exploring the cosmos.',
            'price' => 80000,
            'stock' => 40,
            'cover_photo' => 'journey_stars.jpg',
            'genre_id' => 3, 
            'author_id' => 5, 
        ]);
    }
}
