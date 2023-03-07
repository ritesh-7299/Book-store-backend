<?php

namespace App\Http\Resources\Api;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(request('id')){
            return [
                'id' => $this->id,
                'title' => $this->title,
                'image' => $this->image,
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
            'image' => $this->image,
            'description' => Str::limit($this->description,70),
            'author' => $this->author,
            'published' => $this->published,
            'publisher' => $this->publisher,
        ];
        
    }
}
