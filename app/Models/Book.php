<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "title",
        "author",
        "genre",
        "description",
        "isbn",
        "image",
        "published",
        "publisher"
    ];

    /**
    * Get the indexable data array for the model.
    *
    * @return array
    */
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'author' => $this->author,
            'genre' => $this->genre,
            'isbn' => $this->isbn,
            'published' => $this->published,
            'publisher' => $this->publisher,
        ];
    }
}
