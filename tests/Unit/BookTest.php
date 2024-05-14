<?php

use App\Domain\Book\Models\Book;
use App\Domain\User\Models\User;
use Laravel\Sanctum\Sanctum;

final class BookTest extends \Tests\TestCase
{
    
    private string $endpoint = '/api/books';
    
    public function testListAuthenticated(): void
    {
        $this->actingAs(User::factory()->make());
        
        $response = $this->get($this->endpoint);
    
        $response->assertOk()->assertJsonStructure();
        
    }
    
    public function testListUnauthenticated(): void
    {
        $this->get($this->endpoint)->assertUnauthorized();
    }
    
    public function testShowAuthenticated(): void
    {
        $this->actingAs(User::factory()->make());
    
        if(!Book::query()->count())
            Book::factory()->createOne();
    
        foreach (Book::all() as $book) {
            
            $response = $this->get("{$this->endpoint}/{$book->id}");
    
            $response->assertOk()->assertJsonStructure();
        }
    }
    
    public function testShowUnauthenticated(): void
    {
        if(!Book::query()->count())
            Book::factory()->createOne();
    
        $this->get("{$this->endpoint}/". Book::query()->first() )->assertUnauthorized();
    }
    
    public function testCreateAuthenticated(): void
    {
        $this->actingAs(User::factory()->make());

        foreach (Book::factory()->count(3)->make() as $book) {
    
            $response = $this->post(
                $this->endpoint,
                $book->getAttributes()
            );

            $response->assertOk()->assertJsonStructure();
        }

    }
    
    public function testCreateUnauthenticated(): void
    {
        $book = Book::factory()->make();
        
        $this->post(
            $this->endpoint,
            $book->getAttributes()
        )->assertUnauthorized();

    }
    
    public function testUpdateAuthenticated(): void
    {
        $this->actingAs(User::factory()->make());
        
        foreach (Book::query()->limit(3)->get() as $book) {
            
            $response = $this->put("{$this->endpoint}/{$book->id}", Book::factory()->make()->getAttributes());
            
            $response->assertOk()->assertJsonStructure();
        }
        
    }
    
    public function testUpdateUnauthenticated(): void
    {
        $book = Book::query()->first();
    
        $this->put(
            "{$this->endpoint}/{$book->id}",
            Book::factory()->make()->getAttributes()
        )->assertUnauthorized();
        
    }
    
    public function testDeleteAuthenticated(): void
    {
        $this->actingAs(User::factory()->make());
        
        $book = Book::factory()->createOne();
    
        $response = $this->delete("{$this->endpoint}/{$book->id}");
    
        $response->assertOk()->assertJsonStructure();
        
    }
    
    public function testDeleteUnauthenticated(): void
    {
        $book = Book::factory()->createOne();
    
        $this->delete("{$this->endpoint}/{$book->id}")->assertUnauthorized();
    
    }

}
