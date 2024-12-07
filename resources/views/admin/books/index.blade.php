@extends('layouts.admin')

@section('title', 'Gestion des Livres')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <!-- En-tête avec filtres -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
        <h3 class="text-lg font-semibold flex items-center">
            <i class="fas fa-books text-blue-500 mr-2"></i>
            Liste des livres
        </h3>
        
        <!-- Filtres et recherche -->
        <div class="flex flex-wrap gap-4">
            <div class="relative">
                <input type="text" 
                       id="search"
                       placeholder="Rechercher un livre..."
                       class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>

            <select id="category-filter" 
                    class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    onchange="window.location.href=this.value">
                <option value="{{ route('admin.books') }}">Toutes les catégories</option>
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ route('admin.books', ['category' => $category->id]) }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select id="sort" 
                    class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    onchange="window.location.href=this.value">
                <option value="{{ route('admin.books', ['sort' => 'latest']) }}"
                        {{ request('sort') == 'latest' ? 'selected' : '' }}>
                    Plus récents
                </option>
                <option value="{{ route('admin.books', ['sort' => 'downloads']) }}"
                        {{ request('sort') == 'downloads' ? 'selected' : '' }}>
                    Plus téléchargés
                </option>
                <option value="{{ route('admin.books', ['sort' => 'likes']) }}"
                        {{ request('sort') == 'likes' ? 'selected' : '' }}>
                    Plus aimés
                </option>
            </select>

            <a href="{{ route('books.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>
                Ajouter un livre
            </a>
        </div>
    </div>

    <!-- Liste des livres -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($books as $book)
            <div class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-lg transition duration-200">
                <div class="p-6">
                    <!-- En-tête du livre -->
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="font-semibold text-lg">{{ $book->title }}</h4>
                            <p class="text-gray-600">par {{ $book->author }}</p>
                        </div>
                        @if($book->category)
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                {{ $book->category->name }}
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $book->description }}</p>

                    <!-- Statistiques -->
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span title="Téléchargements">
                            <i class="fas fa-download mr-1"></i>
                            {{ $book->downloads_count }}
                        </span>
                        <span title="Likes">
                            <i class="fas fa-heart mr-1 text-red-500"></i>
                            {{ $book->likes_count }}
                        </span>
                        <span title="Commentaires">
                            <i class="fas fa-comment mr-1 text-blue-500"></i>
                            {{ $book->comments_count }}
                        </span>
                        <span title="Date d'ajout">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $book->created_at->format('d/m/Y') }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center pt-4 border-t">
                        <div class="space-x-2">
                            <a href="{{ route('books.show', $book) }}" 
                               class="text-blue-600 hover:text-blue-800 transition duration-200"
                               title="Voir le livre">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('books.download', $book) }}" 
                               class="text-green-600 hover:text-green-800 transition duration-200"
                               title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                        <form action="{{ route('admin.books.delete', $book) }}" 
                              method="POST" 
                              class="inline-block"
                              onsubmit="event.preventDefault(); showConfirmModal(
                                  '🗑️ Suppression d\'un livre',
                                  `📚 Titre : {{ $book->title }}
                                   ✍️ Auteur : {{ $book->author }}
                                   📂 Catégorie : {{ $book->category ? $book->category->name : 'Aucune' }}
                                   📅 Ajouté le : {{ $book->created_at->format('d/m/Y à H:i') }}
                                   
                                   ⚠️ Cette action est irréversible.`,
                                  this
                              );">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 transition duration-200"
                                    title="Supprimer le livre">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-books text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun livre</h3>
                <p class="text-gray-500">Aucun livre n'a été ajouté pour le moment.</p>
                <a href="{{ route('books.create') }}" 
                   class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-800">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Ajouter un livre
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $books->withQueryString()->links() }}
    </div>
</div>

@push('scripts')
<script>
// Recherche en temps réel
const searchInput = document.getElementById('search');
let timeout = null;

searchInput.addEventListener('input', function() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        const searchParams = new URLSearchParams(window.location.search);
        searchParams.set('search', this.value);
        window.location.search = searchParams.toString();
    }, 500);
});

// Animation de suppression
document.querySelectorAll('form[data-delete="true"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (this.getAttribute('data-confirmed') !== 'true') {
            e.preventDefault();
            if (confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')) {
                this.setAttribute('data-confirmed', 'true');
                this.submit();
            }
        }
    });
});
</script>
@endpush
@endsection 