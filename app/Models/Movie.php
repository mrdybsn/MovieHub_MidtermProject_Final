<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'imdb_id',
        'release_year',
        'director',
        'genre_id',
        'photo',
    ];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
