@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4">
    <!-- En-tête du livre -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-blue-100">Par {{ $book->author }}</p>
                </div>
                @if($book->category)
                    <span class="px-4 py-2 bg-blue-400 bg-opacity-50 rounded-full text-white">
                        {{ $book->category->name }}
                    </span>
                @endif
            </div>
        </div>
        
        <div class="p-6">
            <!-- Description -->
            <div class="prose max-w-none mb-6">
                <h2 class="text-xl font-semibold mb-3">Description</h2>
                <p class="text-gray-700">{{ $book->description }}</p>
            </div>

            <!-- Statistiques -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-50 p-4 rounded-lg text-center">
                    <i class="fas fa-download text-blue-500 text-xl mb-2"></i>
                    <p class="text-sm text-gray-600">Téléchargements</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $book->downloads_count }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg text-center">
                    <i class="fas fa-heart text-red-500 text-xl mb-2"></i>
                    <p class="text-sm text-gray-600">Likes</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $book->likes_count }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg text-center">
                    <i class="fas fa-comments text-green-500 text-xl mb-2"></i>
                    <p class="text-sm text-gray-600">Commentaires</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $book->comments_count }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-between items-center">
                <a href="{{ route('books.download', $book) }}" 
                   class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                    <i class="fas fa-download mr-2"></i>
                    Télécharger le PDF
                </a>
                <div class="flex items-center space-x-4">
                    <button onclick="toggleReaction({{ $book->id }}, 'like')" 
                            class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200
                                   {{ $book->likes()->where('session_id', session()->getId())->where('type', 'like')->exists() ? 'text-blue-600' : 'text-gray-600' }}">
                        <i class="fas fa-thumbs-up mr-2"></i>
                        <span id="likes-count-{{ $book->id }}">{{ $book->likes()->where('type', 'like')->count() }}</span>
                    </button>

                    <button onclick="toggleReaction({{ $book->id }}, 'dislike')" 
                            class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200
                                   {{ $book->likes()->where('session_id', session()->getId())->where('type', 'dislike')->exists() ? 'text-red-600' : 'text-gray-600' }}">
                        <i class="fas fa-thumbs-down mr-2"></i>
                        <span id="dislikes-count-{{ $book->id }}">{{ $book->likes()->where('type', 'dislike')->count() }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Section commentaires -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Commentaires</h2>
            <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                {{ $book->comments_count }} {{ Str::plural('commentaire', $book->comments_count) }}
            </span>
        </div>

        <!-- Formulaire d'ajout de commentaire -->
        <form action="{{ route('comments.store', $book) }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
                <label for="author_name" class="block text-gray-700 text-sm font-bold mb-2">
                    Votre nom (optionnel)
                </label>
                <input type="text" 
                       name="author_name" 
                       id="author_name" 
                       value="{{ old('author_name') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                              @error('author_name') border-red-500 @enderror"
                       placeholder="Votre nom">
                @error('author_name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">
                    Votre commentaire
                </label>
                <textarea name="content" 
                          id="content" 
                          rows="4" 
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                 @error('content') border-red-500 @enderror"
                          placeholder="Partagez votre avis sur ce livre...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-paper-plane mr-2"></i>
                Publier le commentaire
            </button>
        </form>

        <!-- Liste des commentaires -->
        <div class="space-y-6">
            @forelse($book->comments()->latest()->get() as $comment)
                <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition duration-200">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $comment->author_name ?? 'Anonyme' }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $comment->created_at->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-700">{{ $comment->content }}</p>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-comments text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Aucun commentaire pour le moment. Soyez le premier à donner votre avis !</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleReaction(bookId, type) {
    fetch(`/books/${bookId}/likes`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ type: type })
    })
    .then(response => response.json())
    .then(data => {
        // Mise à jour des compteurs
        document.getElementById(`likes-count-${bookId}`).textContent = data.likes_count;
        document.getElementById(`dislikes-count-${bookId}`).textContent = data.dislikes_count;
        
        // Mise à jour des styles des boutons
        const likeButton = document.querySelector(`button[onclick="toggleReaction(${bookId}, 'like')]`);
        const dislikeButton = document.querySelector(`button[onclick="toggleReaction(${bookId}, 'dislike')]`);
        
        // Réinitialisation des styles
        likeButton.classList.remove('text-blue-600');
        dislikeButton.classList.remove('text-red-600');
        likeButton.classList.add('text-gray-600');
        dislikeButton.classList.add('text-gray-600');
        
        // Application du style actif
        if (data.current_type === 'like') {
            likeButton.classList.remove('text-gray-600');
            likeButton.classList.add('text-blue-600');
        } else if (data.current_type === 'dislike') {
            dislikeButton.classList.remove('text-gray-600');
            dislikeButton.classList.add('text-red-600');
        }
    });
}
</script>
@endpush
@endsection 