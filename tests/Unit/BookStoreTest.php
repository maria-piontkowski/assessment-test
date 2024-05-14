<?php

use App\Domain\Book\Models\Book;
    use App\Domain\Store\Models\Store;
    use App\Domain\User\Models\User;
use Laravel\Sanctum\Sanctum;

final class BookStoreTest extends \Tests\TestCase
{
    
    private string $endpoint = '/api/book-store';
    
    public function testAuthenticated(): void
    {
        $this->actingAs(User::factory()->make());
        
        $books = Book::factory()->createMany(3);
        $stores = Store::factory()->createMany(3);
        
        foreach ($books as $book) {
            
            foreach ($stores as $store) {
                
                $response = $this->post("{$this->endpoint}/{$book->id}/{$store->id}");
                $response->assertOk()->assertJsonStructure();
                
                $response = $this->delete("{$this->endpoint}/{$book->id}/{$store->id}");
                $response->assertOk()->assertJsonStructure();
            }
            
        }
    
        $books->each(fn ($book) => $book->delete());
        $stores->each(fn ($store) => $store->delete());
    }
    
    public function testUnauthenticated(): void
    {
        $book = Book::factory()->createOne();
        $store = Store::factory()->createOne();
    
        $this->post("{$this->endpoint}/{$book->id}/{$store->id}")->assertUnauthorized();
        $this->delete("{$this->endpoint}/{$book->id}/{$store->id}")->assertUnauthorized();
    
        $book->delete();
        $store->delete();
    }
    
    

}
