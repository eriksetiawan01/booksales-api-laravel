<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'J.K. Rowling',
            'bio' => 'British author, best known for the Harry Potter series.',
            'cover_photo' => 'jk_rowling.jpg',
        ]);
        Author::create([
            'name' => 'George R.R. Martin',
            'bio' => 'American novelist and short story writer, known for A Song of Ice and Fire series.',
            'cover_photo' => 'george_rr_martin.jpg',
        ]);
        Author::create([
            'name' => 'Agatha Christie',
            'bio' => 'English writer known for her detective novels and short stories.',
            'cover_photo' => 'agatha_christie.jpg',
        ]);
        Author::create([
            'name' => 'Stephen King',
            'bio' => 'American author of horror, supernatural fiction, suspense, and fantasy novels.',
            'cover_photo' => 'stephen_king.jpg',
        ]);
        Author::create([
            'name' => 'Jane Austen',
            'bio' => 'English novelist known primarily for her six major novels including Pride and Prejudice.',
            'cover_photo' => 'jane_austen.jpg',
        ]);
    }
}
