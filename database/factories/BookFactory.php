<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $authors = ['Agatha Christie','William Shakespeare','Barbara Cartland','Danielle Steel','Harold Robbins',
                    'Georges Simenon','J. K. Rowling','Enid Blyton','Dean Koontz','Stephen King',
                    'Jin Yong','Zane Grey','Gosho Aoyama'];
        $genres = ['Fantasy','Horror','Romance','Mystery','Drama'];
        $publishers = ['Harper Collins','Simon & Schuster','Hachette','Packt','Macmillan','Roli Books'];
        
        return [
            "title" => $this->faker->words(rand(2,4),true),
            "author" => $this->faker->randomElement($authors),
            "genre"=> $this->faker->randomElement($genres),
            "description" => $this->faker->words(50,true),
            "isbn" => $this->faker->numerify('#############'),
            "image" => "http://placeimg.com/480/640/any",
            "published" => $this->faker->date(),
            "publisher" => $this->faker->randomElement($publishers)
        ];
    }
}
