@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
<!-- Statistiques -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Livres -->
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-books text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Total des livres</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_books'] }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.books') }}" 
               class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                <span>Voir les détails</span>
                <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Catégories -->
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-folder text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Catégories</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_categories'] }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.categories') }}" 
               class="text-green-600 hover:text-green-800 text-sm flex items-center">
                <span>Voir les détails</span>
                <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Commentaires -->
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-comments text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Commentaires</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_comments'] }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.comments') }}" 
               class="text-yellow-600 hover:text-yellow-800 text-sm flex items-center">
                <span>Voir les détails</span>
                <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- FAQs -->
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-question-circle text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">FAQs</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_faqs'] }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.faqs') }}" 
               class="text-purple-600 hover:text-purple-800 text-sm flex items-center">
                <span>Voir les détails</span>
                <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

<!-- Dernières activités -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Derniers livres -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Derniers livres ajoutés</h3>
            <a href="{{ route('admin.books') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                Voir tout
            </a>
        </div>
        <div class="space-y-4">
            @foreach($latest_books as $book)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                    <div>
                        <h4 class="font-medium">{{ $book->title }}</h4>
                        <p class="text-sm text-gray-500">par {{ $book->author }}</p>
                        @if($book->category)
                            <span class="inline-block mt-1 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                {{ $book->category->name }}
                            </span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $book->created_at->format('d/m/Y') }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Derniers commentaires -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Derniers commentaires</h3>
            <a href="{{ route('admin.comments') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                Voir tout
            </a>
        </div>
        <div class="space-y-4">
            @foreach($latest_comments as $comment)
                <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium">{{ $comment->author_name ?? 'Anonyme' }}</p>
                                <p class="text-sm text-gray-500">
                                    sur "{{ $comment->book->title }}"
                                </p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $comment->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">
                        {{ Str::limit($comment->content, 100) }}
                    </p>
                    <form action="{{ route('admin.comments.delete', $comment) }}" 
                          method="POST" 
                          class="inline-block"
                          onsubmit="event.preventDefault(); showConfirmModal(
                              '🗑️ Suppression d\'un commentaire',
                              `💬 Commentaire de : {{ $comment->author_name ?? 'Anonyme' }}
                               📚 Sur le livre : {{ $comment->book->title }}
                               📅 Posté le : {{ $comment->created_at->format('d/m/Y à H:i') }}
                               
                               ⚠️ Cette action est irréversible.`,
                              this
                          );">
                          @csrf
                          @method('DELETE')
                          <button type="submit" 
                                  class="text-red-600 hover:text-red-800 transition duration-200"
                                  title="Supprimer le commentaire">
                              <i class="fas fa-trash"></i>
                          </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 