@extends('layouts.admin')

@section('title', 'Gestion des Commentaires')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold flex items-center">
            <i class="fas fa-comments text-blue-500 mr-2"></i>
            Liste des commentaires
        </h3>
        <!-- Filtres -->
        <div class="flex space-x-4">
            <select id="filter" 
                    class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    onchange="window.location.href=this.value">
                <option value="{{ route('admin.comments') }}" {{ !request('filter') ? 'selected' : '' }}>
                    Tous les commentaires
                </option>
                <option value="{{ route('admin.comments', ['filter' => 'recent']) }}" 
                        {{ request('filter') === 'recent' ? 'selected' : '' }}>
                    Plus récents
                </option>
                <option value="{{ route('admin.comments', ['filter' => 'old']) }}" 
                        {{ request('filter') === 'old' ? 'selected' : '' }}>
                    Plus anciens
                </option>
            </select>
        </div>
    </div>

    <!-- Liste des commentaires -->
    <div class="space-y-4">
        @forelse($comments as $comment)
            <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition duration-200">
                <div class="flex items-start justify-between">
                    <!-- Informations du commentaire -->
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="ml-3">
                                <p class="font-semibold">{{ $comment->author_name ?? 'Anonyme' }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $comment->created_at->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="ml-13">
                            <a href="{{ route('books.show', $comment->book) }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium mb-2 block">
                                Sur "{{ $comment->book->title }}"
                            </a>
                            <p class="text-gray-700">{{ $comment->content }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="ml-4 flex items-start space-x-2">
                        <form action="{{ route('admin.comments.delete', $comment) }}" 
                              method="POST" 
                              class="inline-block"
                              onsubmit="event.preventDefault(); showConfirmModal(
                                  '🗑️ Suppression d\'un commentaire',
                                  `💬 Auteur : {{ $comment->author_name ?? 'Anonyme' }}
                                   📚 Livre : {{ $comment->book->title }}
                                   📅 Date : {{ $comment->created_at->format('d/m/Y à H:i') }}
                                   📝 Contenu : {{ Str::limit($comment->content, 100) }}
                                   
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
                </div>

                <!-- Statistiques -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span title="Date de création">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                        <span title="Livre">
                            <i class="fas fa-book mr-1"></i>
                            {{ $comment->book->title }}
                        </span>
                        <span title="Catégorie">
                            <i class="fas fa-folder mr-1"></i>
                            {{ $comment->book->category->name ?? 'Sans catégorie' }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-comments text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun commentaire</h3>
                <p class="text-gray-500">Aucun commentaire n'a été publié pour le moment.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $comments->withQueryString()->links() }}
    </div>
</div>

@push('scripts')
<script>
// Ne cibler que les formulaires avec l'attribut data-delete="true"
document.querySelectorAll('form[data-delete="true"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (this.getAttribute('data-confirmed') !== 'true') {
            e.preventDefault();
            if (confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) {
                this.setAttribute('data-confirmed', 'true');
                this.submit();
            }
        }
    });
});
</script>
@endpush
@endsection 