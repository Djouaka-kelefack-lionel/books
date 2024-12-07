@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <!-- En-tête -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-12 px-6 rounded-lg mb-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Bibliothèque</h1>
        <p class="text-lg text-blue-100">Découvrez notre collection de livres numériques</p>
    </div>

    <!-- Filtres et Recherche -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8 fade-in">
        <form action="{{ route('books.index') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
            <!-- Recherche -->
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           id="search"
                           value="{{ request('search') }}"
                           placeholder="Titre, auteur ou catégorie..." 
                           class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Filtre par catégorie -->
            <div class="w-full md:w-48">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                <select name="category" 
                        id="category"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        onchange="this.form.submit()">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tri -->
            <div class="w-full md:w-48">
                <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Trier par</label>
                <select name="sort" 
                        id="sort"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        onchange="this.form.submit()">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Plus récents</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Titre A-Z</option>
                    <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Auteur A-Z</option>
                    <option value="most_liked" {{ request('sort') == 'most_liked' ? 'selected' : '' }}>Plus aimés</option>
                    <option value="most_downloaded" {{ request('sort') == 'most_downloaded' ? 'selected' : '' }}>Plus téléchargés</option>
                </select>
            </div>

            <!-- Boutons -->
            <div class="flex space-x-2">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    Rechercher
                </button>
                @if(request()->hasAny(['search', 'category', 'sort']))
                    <a href="{{ route('books.index') }}" 
                       class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200 flex items-center">
                        <i class="fas fa-undo mr-2"></i>
                        Réinitialiser
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Liste des livres -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($books as $book)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover-scale">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold">
                            <a href="{{ route('books.show', $book) }}" 
                               class="hover:text-blue-600 transition duration-200">
                                {{ $book->title }}
                            </a>
                        </h3>
                        @if($book->category)
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                {{ $book->category->name }}
                            </span>
                        @endif
                    </div>
                    <p class="text-gray-600 mb-2">Par {{ $book->author }}</p>
                    <p class="text-gray-700 mb-4 line-clamp-3">{{ $book->description }}</p>
                    
                    <div class="flex justify-between items-center">
                        <a href="{{ route('books.download', $book) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                            <i class="fas fa-download mr-2"></i>
                            Télécharger
                        </a>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600" title="Téléchargements">
                                <i class="fas fa-download"></i>
                                <span class="ml-1">{{ $book->downloads_count }}</span>
                            </span>
                            <button onclick="toggleReaction({{ $book->id }}, 'like')" 
                                    class="text-gray-600 hover:text-red-500 transition duration-200">
                                <i class="fas fa-heart"></i>
                                <span id="likes-count-{{ $book->id }}" class="ml-1">
                                    {{ $book->likes_count }}
                                </span>
                            </button>
                            <a href="{{ route('books.show', $book) }}" 
                               class="text-gray-600 hover:text-blue-500 transition duration-200">
                                <i class="fas fa-comment"></i>
                                <span class="ml-1">{{ $book->comments_count }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="bg-gray-100 rounded-lg p-8 inline-block">
                    <i class="fas fa-books text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Aucun livre ne correspond à votre recherche.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $books->withQueryString()->links() }}
    </div>
</div>
@endsection