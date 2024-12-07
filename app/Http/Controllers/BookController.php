<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Faq;

class BookController extends Controller
{
    public function index(Request $request)
    {
        if ($request->routeIs('home')) {
            $latestBooks = Book::with(['category', 'comments'])
                ->latest()
                ->take(6)
                ->get();

            $totalBooks = Book::count();
            $totalDownloads = Book::sum('downloads_count');
            $totalLikes = Book::sum('likes_count');
            $faqs = Faq::orderBy('order')->get();

            return view('home', compact('latestBooks', 'totalBooks', 'totalDownloads', 'totalLikes', 'faqs'));
        }

        $query = Book::query();

        // Recherche par titre, auteur ou catégorie
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filtre par catégorie
        if ($categoryId = $request->input('category')) {
            $query->where('category_id', $categoryId);
        }

        // Tri
        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'title':
                $query->orderBy('title');
                break;
            case 'author':
                $query->orderBy('author');
                break;
            case 'most_liked':
                $query->orderBy('likes_count', 'desc');
                break;
            case 'most_downloaded':
                $query->orderBy('downloads_count', 'desc');
                break;
            default:
                $query->latest();
        }

        // Chargement des relations et pagination
        $books = $query->with(['category', 'comments'])->paginate(12);
        $categories = \App\Models\Category::orderBy('name')->get();
        
        return view('books.index', compact('books', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'pdf_file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            ], [
                'title.required' => 'Le titre du livre est obligatoire',
                'title.max' => 'Le titre ne doit pas dépasser 255 caractères',
                'author.required' => 'Le nom de l\'auteur est obligatoire',
                'author.max' => 'Le nom de l\'auteur ne doit pas dépasser 255 caractères',
                'description.required' => 'La description est obligatoire',
                'category_id.required' => 'La catégorie est obligatoire',
                'category_id.exists' => 'La catégorie sélectionnée n\'existe pas',
                'pdf_file.required' => 'Le fichier PDF est obligatoire',
                'pdf_file.mimes' => 'Le fichier doit être au format PDF',
                'pdf_file.max' => 'Le fichier ne doit pas dépasser 10 Mo',
            ]);

            // Nettoyer les caractères spéciaux du titre et de l'auteur
            $validated['title'] = preg_replace('/[^a-zA-Z0-9\s\-\_\'\"\&\(\)\[\]\{\}\.,;:!?àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ]/u', '', $validated['title']);
            $validated['author'] = preg_replace('/[^a-zA-Z0-9\s\-\_\'\"\&\(\)\[\]\{\}\.,;:!?àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ]/u', '', $validated['author']);

            if (empty($validated['title']) || empty($validated['author'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'character_error' => 'Le titre et l\'auteur ne peuvent contenir que des lettres, des chiffres, des espaces et les caractères spéciaux suivants : - _ \' " & ( ) [ ] { } . , ; : ! ?'
                    ]);
            }

            // Traitement du fichier PDF
            $pdfPath = $request->file('pdf_file')->store('books', 'public');
            
            // Création du livre
            $book = Book::create([
                'title' => $validated['title'],
                'author' => $validated['author'],
                'description' => $validated['description'],
                'category_id' => $validated['category_id'],
                'pdf_path' => $pdfPath,
            ]);

            return redirect()
                ->route('books.show', $book)
                ->with('success', 'Le livre a été ajouté avec succès.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Une erreur est survenue lors de l\'ajout du livre. Détails : ' . $e->getMessage()
                ]);
        }
    }

    public function download(Book $book)
    {
        $originalName = basename($book->pdf_path);
        
        $downloadName = Str::slug($book->title) . '.pdf';
        
        $book->increment('downloads_count');
        
        return Storage::disk('public')->download(
            $book->pdf_path,
            $downloadName
        );
    }

    public function create()
    {
        return view('books.create');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
} 