<?php

namespace App\Domain\Book\Models;

use App\Domain\Store\Models\Store;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'isbn',
        'value'
    ];
    
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array
     */
    protected $casts = [
        'isbn' => 'integer',
        'value' => 'decimal:2',
    ];
    
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['stores'];
    
    
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
        return BookFactory::new();
    }
    
    /**
     * Get all of the stores for the book.
     */
    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class)->without('books');
    }
}
