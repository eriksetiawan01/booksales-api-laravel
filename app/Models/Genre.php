<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        ['id' => 1, 'name' => 'Fiction', 'description' => 'Fictional works including novels and short stories.'],
        ['id' => 2, 'name' => 'Non-Fiction', 'description' => 'Non-fictional works including biographies and self-help books.'],
        ['id' => 3, 'name' => 'Fantasy', 'description' => 'Fantasy works including epic and urban fantasy.'],
        ['id' => 4, 'name' => 'Mystery', 'description' => 'Mystery works including detective and crime fiction.'],
        ['id' => 5, 'name' => 'Romance', 'description' => 'Romance works including contemporary and historical romance.'],
        ['id' => 6, 'name' => 'Horror', 'description' => 'Horror works including supernatural and psychological horror.'],
    ];

    public function getGenres()
    {
        return $this->genres;
    }   
}
