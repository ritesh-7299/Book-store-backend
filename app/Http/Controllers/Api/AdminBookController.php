<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BookRequest;
use App\Http\Resources\Api\AdminBookResourse;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    /**
     * Showing listing of all books to admin dashboard
     *
     * @param  \Illuminate\Http\Request   $request 
     * @return Collection
     */
    public function index(Request $request){
        return AdminBookResourse::collection(Book::search($request->search)->paginate(10));
    }

    /**
     * Return Data of one book for detail book page admin
     *  
     * @param  Book   $book 
     * @return JsonResponse
     */
    public function show(Book $book){
        try {
            $data = new AdminBookResourse($book);

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
     * Store Book data to data base admin  
     * 
     * @param  BookRequest $request 
     * @return JsonResponse
     */ 
    public function store(BookRequest $request){
        try {
            $image = '';
            if($request->file()){
                $image = $this->uploadImage($request->file);
            }
            $input = $request->all();
            $input['image'] = $image;

            Book::create($input);
            
            $response = [
                'success' => true,
                'message' => 'Book is stored successfully.'
            ];
            
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => $e->getMessage() 
            ];

            return response()->json($response,500);
        }
    }

    /**
     * Update book's information admin
     * 
     * @param  BookRequest $request 
     * @param  Book $book 
     * @return JsonResponse
     */
    public function update(BookRequest $request,Book $book){
        try {
            $input = $request->all();
            
            if($request->file()){
                $input['image']  = $this->uploadImage($request->file);    
            }
    
            $book->update($input);
        
            $response = [
                'success' => true,
                'message' => 'Book is updated successfully.'
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
     * Delete a book from the database
     * 
     * @param  Book $book 
     * @return JsonResponse
     */
    public function destroy(Book $book){ 
        try {
            $book->delete();
    
            $response = [
                'success' => true,
                'message' => "Book is deleted"
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
     * Function to save an image file 
     * 
     * @param  File $file 
     * @return String 
     */
    public function uploadImage($file){
            $filename = time().'-'.$file->getClientOriginalName();
            $file->storeAs('public/images',$filename);   
            
            return asset('storage/images/'.$filename);
    }
}
