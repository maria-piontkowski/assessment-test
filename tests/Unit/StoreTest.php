<?php

use App\Domain\Store\Models\Store;
use App\Domain\User\Models\User;
use Laravel\Sanctum\Sanctum;

final class StoreTest extends \Tests\TestCase
{
    
    private string $endpoint = '/api/stores';
    
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
        
        if(!Store::query()->count())
            Store::factory()->createOne();
            
        foreach (Store::all() as $store) {
    
            $response = $this->get("{$this->endpoint}/{$store->id}");
    
            $response->assertOk()->assertJsonStructure();
        }
        
    }
    
    public function testShowUnauthenticated(): void
    {
        if(!Store::query()->count())
            Store::factory()->createOne();
    
        $this->get("{$this->endpoint}/". Store::query()->first() )->assertUnauthorized();
        
    }
    
    public function testCreateAuthenticated(): void
    {
        $this->actingAs(User::factory()->make());

        foreach (Store::factory()->count(3)->make() as $store) {
    
            $response = $this->post(
                $this->endpoint,
                $store->getAttributes()
            );

            $response->assertOk()->assertJsonStructure();
        }

    }
    
    public function testCreateUnauthenticated(): void
    {
        $store = Store::factory()->make();
        
        $this->post(
            $this->endpoint,
            $store->getAttributes()
        )->assertUnauthorized();

    }
    
    public function testUpdateAuthenticated(): void
    {
        $this->actingAs(User::factory()->make());
        
        foreach (Store::query()->limit(3)->get() as $store) {
            
            $response = $this->put(
                "{$this->endpoint}/{$store->id}",
                Store::factory()->make()->getAttributes()
            );
            
            $response->assertOk()->assertJsonStructure();
        }
        
    }
    
    public function testUpdateUnauthenticated(): void
    {
        $store = Store::query()->first();
        
        $this->put(
            "{$this->endpoint}/{$store->id}",
            Store::factory()->make()->getAttributes()
        )->assertUnauthorized();
        
    }
    
    public function testDeleteAuthenticated(): void
    {
        $this->actingAs(User::factory()->make());
        
        $store = Store::factory()->createOne();
    
        $response = $this->delete("{$this->endpoint}/{$store->id}");
    
        $response->assertOk()->assertJsonStructure();
        
    }
    
    public function testDeleteUnauthenticated(): void
    {
        $store = Store::factory()->createOne();
    
        $this->delete("{$this->endpoint}/{$store->id}")->assertUnauthorized();
        
    }

}
