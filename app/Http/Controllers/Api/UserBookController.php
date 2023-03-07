<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserBookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    // Consant array to store filter's keys
    const FILTERKEYS = ['title','author','published','isbn','genre','publisher'];

    /**
     * Api to send data for listing page
     * 
     * @param  \Illuminate\Http\Request   $request 
     * @return Collection
     */
    public function index(Request $request)
    {
        $books = Book::search($request->search);
        
        foreach(self::FILTERKEYS as $key){
            if($request->has($key)){
                $books = $books->where($key,$request->$key);
            }
        }   
        $filters = collect($this->generateFilters($books)); 
        $bookData = UserBookResource::collection($books->paginate(9))->additional(['filters' =>$filters]);
        
        return $bookData;
    }
    
    
    /**
     * Api to send data of specific book to detail page
     * 
     * @param  int $id 
     * @return Collection
     */
    public function show($id)
    {
        try {
            $book = Book::find($id);
            $data = new UserBookResource($book);

            $response = [
                'success' => true,
                'data' => $data 
            ];

            return response()->json($response,200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => $e->getMessage() 
            ];

            return response()->json($response,500);
        }
    }
    
    /**
     * Api to send data for filter
     * 
     * @param collection $data
     * @return array
     */
    public function generateFilters($data)
    {
        $filters = [];
        foreach(self::FILTERKEYS as $key){
            $book = $data->get([$key])->unique($key)->pluck($key);
            $filters[$key] = $book;
        }

        return $filters;
    }
}
