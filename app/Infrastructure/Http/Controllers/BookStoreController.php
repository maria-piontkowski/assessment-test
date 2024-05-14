<?php

namespace App\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Domain\Book\Models\Book;
use App\Domain\Store\Models\Store;

class BookStoreController extends Controller
{
    /**
     * Add book store relationship.
     * @param Book $book
     * @param Store $store
     * @return JsonResponse
     */
    public function add(Book $book, Store $store)
    {
        $book->stores()->syncWithoutDetaching($store->id);
        
        return response()->json([
            'message' => "Successfully added book {$book->id} to store {$store->id}"
        ]);
    }
    
    /**
     * Remove book store relationship.
     * @param Book $book
     * @param Store $store
     * @return JsonResponse
     */
    public function remove(Book $book, Store $store)
    {
        $book->stores()->detach($store->id);
        
        return response()->json([
            'message' => "Successfully removed book {$book->id} from store {$store->id}"
        ]);
    }
}
