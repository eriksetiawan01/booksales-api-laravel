<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
        ['id' => 1, 'name' => 'J.K. Rowling', 'bio' => 'British author, best known for the Harry Potter series.'],
        ['id' => 2, 'name' => 'George R.R. Martin', 'bio' => 'American novelist and short story writer, known for A Song of Ice and Fire series.'],
        ['id' => 3, 'name' => 'Agatha Christie', 'bio' => 'English writer known for her detective novels and short stories.'],
        ['id' => 4, 'name' => 'Stephen King', 'bio' => 'American author of horror, supernatural fiction, suspense, and fantasy novels.'],
        ['id' => 5, 'name' => 'Jane Austen', 'bio' => 'English novelist known primarily for her six major novels including Pride and Prejudice.'],
        ['id' => 6, 'name' => 'Mark Twain', 'bio' => 'American writer, humorist, entrepreneur, publisher, and lecturer.'],
    ];

    public function getAuthors()
    {
        return $this->authors;
    }
}
