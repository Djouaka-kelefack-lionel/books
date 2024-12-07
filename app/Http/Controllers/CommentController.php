<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000',
            'author_name' => 'nullable|string|max:255'
        ], [
            'content.required' => 'Le commentaire ne peut pas être vide',
            'content.min' => 'Le commentaire doit contenir au moins 3 caractères',
            'content.max' => 'Le commentaire ne doit pas dépasser 1000 caractères',
            'author_name.max' => 'Le nom ne doit pas dépasser 255 caractères'
        ]);

        $comment = new Comment([
            'content' => $validated['content'],
            'author_name' => $validated['author_name'] ?? 'Anonyme'
        ]);

        $book->comments()->save($comment);
        
        $book->increment('comments_count');

        return back()->with('success', 'Commentaire ajouté avec succès');
    }
} 