<?php

namespace App\Domain\Store\Models;

use App\Domain\Book\Models\Book;
use Database\Factories\StoreFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'active'
    ];
    
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array
     */
    protected $casts = [
        'active' => 'boolean'
    ];
    
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['books'];
    
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['pivot'];
    
    
    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return StoreFactory::new();
    }
    
    /**
     * Get all of the books for the store.
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->without('stores');
    }
    
}
