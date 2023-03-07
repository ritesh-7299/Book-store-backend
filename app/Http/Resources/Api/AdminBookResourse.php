<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class AdminBookResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(Route::currentRouteName() =='book.show'){
            return [
                'title' => $this->title,
                'file' => $this->image,
                'description' => $this->description,
                'author' => $this->author,
                'published' => $this->published,
                'publisher' => $this->publisher,
                'isbn' => $this->isbn,
                'genre' => $this->genre
            ];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'published' => $this->published,
        ];
    }
}
