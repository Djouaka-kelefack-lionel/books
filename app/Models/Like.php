<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'type'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
} 