<?php

use App\Domain\Book\Models\Book;
use App\Domain\User\Models\User;
use Laravel\Sanctum\Sanctum;

final class AuthTest extends \Tests\TestCase
{
    private string $endpoint = '/api/books';
    
    public function testLogin(): void
    {
        $password = fake()->password();
    
        $user = User::factory()->createOne(['password' => $password]);
        
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
    
        $response->assertOk();
        $response->assertJsonStructure(['token_type', 'access_token']);
    
        $user->delete();
        
    }
    
    public function testLogout(): void
    {
        Sanctum::actingAs(User::factory()->make());
        $this->get('/api/logout')->assertOk();
    }
    
    
}
