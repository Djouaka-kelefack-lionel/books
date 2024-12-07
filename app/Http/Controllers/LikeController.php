<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Book $book)
    {
        $sessionId = session()->getId();
        $type = $request->input('type', 'like');

        $existingLike = $book->likes()
            ->where('session_id', $sessionId)
            ->first();

        if ($existingLike) {
            if ($existingLike->type === $type) {
                // Si même type, on supprime le like/dislike
                $existingLike->delete();
                $currentType = null;
            } else {
                // Si type différent, on change le type
                $existingLike->update(['type' => $type]);
                $currentType = $type;
            }
        } else {
            // Création d'un nouveau like/dislike
            $book->likes()->create([
                'session_id' => $sessionId,
                'type' => $type
            ]);
            $currentType = $type;
        }

        // Recalculer les compteurs
        $likesCount = $book->likes()->where('type', 'like')->count();
        $dislikesCount = $book->likes()->where('type', 'dislike')->count();

        // Mettre à jour les compteurs dans la table books
        $book->update([
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount
        ]);

        return response()->json([
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'current_type' => $currentType
        ]);
    }
} 