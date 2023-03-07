<?php

namespace App\Http\Requests\Api;

// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if(request()->file()){
            return [
                "title" => "required",
                "author" => "required",
                "genre"=> "required",
                "description"=>"required",
                "file" => "file|mimes:jpg,png,jpeg",
                "isbn" => "digits:13",
                "published"=> "required|date",
                "publisher"=> "required"
            ];
        }
        return [
            "title" => "required",
            "author" => "required",
            "genre"=> "required",
            "description"=>"required",
            "isbn" => "digits:13",
            "published"=> "required|date",
            "publisher"=> "required"
        ];
    }
}
