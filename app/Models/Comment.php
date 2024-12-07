<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'content',
        'author_name'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
} 