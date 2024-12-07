<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BookController::class, 'index'])->name('home');

// Routes pour les livres
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}/download', [BookController::class, 'download'])->name('books.download');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Routes pour les interactions
Route::post('/books/{book}/likes', [LikeController::class, 'toggle'])->name('likes.toggle');
Route::post('/books/{book}/comments', [CommentController::class, 'store'])->name('comments.store');

// Routes Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminController::class, 'login'])->name('login');
    Route::post('login', [AdminController::class, 'authenticate'])->name('authenticate');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('logout');
        
        // Gestion des livres
        Route::get('books', [AdminController::class, 'books'])->name('books');
        Route::delete('books/{book}', [AdminController::class, 'deleteBook'])->name('books.delete');
        
        // Gestion des catégories
        Route::get('categories', [AdminController::class, 'categories'])->name('categories');
        Route::post('categories', [AdminController::class, 'storeCategory'])->name('categories.store');
        Route::delete('categories/{category}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
        
        // Gestion des commentaires
        Route::get('comments', [AdminController::class, 'comments'])->name('comments');
        Route::delete('comments/{comment}', [AdminController::class, 'deleteComment'])->name('comments.delete');
        
        // Gestion des FAQs
        Route::get('faqs', [AdminController::class, 'faqs'])->name('faqs');
        Route::post('faqs', [AdminController::class, 'storeFaq'])->name('faqs.store');
        Route::put('faqs/{faq}', [AdminController::class, 'updateFaq'])->name('faqs.update');
        Route::delete('faqs/{faq}', [AdminController::class, 'deleteFaq'])->name('faqs.delete');
    });
});
