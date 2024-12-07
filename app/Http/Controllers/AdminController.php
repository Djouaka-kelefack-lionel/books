<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_categories' => Category::count(),
            'total_comments' => Comment::count(),
            'total_faqs' => Faq::count(),
        ];

        $latest_books = Book::latest()->take(5)->get();
        $latest_comments = Comment::with('book')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latest_books', 'latest_comments'));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'password' => 'required'
        ]);

        if ($credentials['password'] === env('ADMIN_PASSWORD')) {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'password' => 'Mot de passe incorrect'
        ]);
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('home');
    }

    // Gestion des livres
    public function books()
    {
        $books = Book::with(['category', 'comments'])->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function deleteBook(Book $book)
    {
        $book->delete();
        return back()->with('success', 'Livre supprimé avec succès');
    }

    // Gestion des catégories
    public function categories()
    {
        $categories = Category::withCount('books')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string'
        ]);

        Category::create($validated);
        return back()->with('success', 'Catégorie créée avec succès');
    }

    public function deleteCategory(Category $category)
    {
        // Vérifier si la catégorie contient des livres
        if ($category->books()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer une catégorie qui contient des livres');
        }

        $category->delete();
        return back()->with('success', 'Catégorie supprimée avec succès');
    }

    // Gestion des commentaires
    public function comments()
    {
        $comments = Comment::with(['book'])->latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Commentaire supprimé avec succès');
    }

    // Gestion des FAQs
    public function faqs()
    {
        $faqs = Faq::orderBy('order')->paginate(10);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'required|integer|min:0'
        ]);

        Faq::create($validated);
        return back()->with('success', 'FAQ créée avec succès');
    }

    public function updateFaq(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'required|integer|min:0'
        ]);

        $faq->update($validated);
        return back()->with('success', 'FAQ mise à jour avec succès');
    }

    public function deleteFaq(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ supprimée avec succès');
    }
} 