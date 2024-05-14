<?php

namespace App\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Domain\Book\Models\Book;
use App\Infrastructure\Http\Requests\StoreBookRequest;
use App\Infrastructure\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::all());
    }
    
    /**
     * Store a newly created resource in storage.
     * @param StoreBookRequest $request
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::query()->create(
            $request->only('name', 'isbn', 'value')
        );
        
        return response()->json([
            'message' => 'Book successfully created!',
            'data' => $book
        ]);
    }
    
    /**
     * Display the specified resource.
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }
    
    /**
     * Update the specified resource in storage.
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update(
            $request->only('name', 'isbn', 'value')
        );
    
        return response()->json([
            'message' => 'Book successfully updated!',
            'data' => $book
        ]);
        
    }
    
    /**
     * Remove the specified resource from storage.
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        
        return response()->json([
            'message' => 'Book successfully deleted!'
        ]);
    }
}
