<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'author',
        'pages',
        'genre',
        'publishDate',
        'read',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
