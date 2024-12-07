@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="container mx-auto px-4 py-20">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 animate-fade-in">
                Bienvenue sur BiblioTech
            </h1>
            <p class="text-xl mb-8 text-blue-100">
                Votre bibliothèque numérique gratuite pour partager et découvrir des livres au format PDF
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('books.index') }}" 
                   class="px-8 py-4 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition duration-200 hover-scale">
                    <i class="fas fa-books mr-2"></i>
                    Parcourir la bibliothèque
                </a>
                <a href="{{ route('books.create') }}" 
                   class="px-8 py-4 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-400 transition duration-200 hover-scale">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Ajouter un livre
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center hover-scale">
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ $totalBooks }}</div>
                <div class="text-gray-600">
                    <i class="fas fa-books text-2xl mb-2"></i>
                    <p>Livres disponibles</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center hover-scale">
                <div class="text-4xl font-bold text-green-600 mb-2">{{ $totalDownloads }}</div>
                <div class="text-gray-600">
                    <i class="fas fa-download text-2xl mb-2"></i>
                    <p>Téléchargements</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center hover-scale">
                <div class="text-4xl font-bold text-red-600 mb-2">{{ $totalLikes }}</div>
                <div class="text-gray-600">
                    <i class="fas fa-heart text-2xl mb-2"></i>
                    <p>Likes</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Derniers livres -->
<div class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Derniers livres ajoutés</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latestBooks as $book)
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
                        <p class="text-gray-600 mb-4">Par {{ $book->author }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('books.download', $book) }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-200">
                                <i class="fas fa-download mr-2"></i>
                                Télécharger
                            </a>
                            <div class="flex items-center gap-2">
                                <span title="Likes" class="text-gray-600">
                                    <i class="fas fa-heart text-red-500"></i> {{ $book->likes_count }}
                                </span>
                                <span title="Commentaires" class="text-gray-600">
                                    <i class="fas fa-comment text-blue-500"></i> {{ $book->comments_count }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('books.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-arrow-right mr-2"></i>
                Voir tous les livres
            </a>
        </div>
    </div>
</div>

<!-- À propos -->
<div id="about" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-center">À propos de BiblioTech</h2>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <p class="text-gray-600 mb-6">
                    BiblioTech est une plateforme gratuite de partage de livres numériques au format PDF. 
                    Notre mission est de faciliter l'accès à la connaissance et à la culture pour tous.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold mb-4">Pour les lecteurs</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Accès gratuit à une large collection
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Téléchargement facile et rapide
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Recherche par catégories
                            </li>
                        </ul>
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold mb-4">Pour les contributeurs</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Partage simple et rapide
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Statistiques de téléchargement
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Système de likes et commentaires
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ -->
<div id="faq" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Questions fréquentes</h2>
        <div class="max-w-3xl mx-auto space-y-4">
            @foreach($faqs as $faq)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale">
                    <button onclick="toggleFaq('faq-{{ $faq->id }}')" 
                            class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50">
                        <h3 class="text-lg font-semibold">{{ $faq->question }}</h3>
                        <i class="fas fa-chevron-down transform transition-transform duration-200" 
                           id="icon-faq-{{ $faq->id }}"></i>
                    </button>
                    <div id="faq-{{ $faq->id }}" 
                         class="hidden px-6 py-4 border-t bg-gray-50"
                         style="display: none;">
                        <p class="text-gray-600">{{ $faq->answer }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleFaq(faqId) {
    const content = document.getElementById(faqId);
    const icon = document.getElementById('icon-' + faqId);
    const allFaqs = document.querySelectorAll('[id^="faq-"]');
    const allIcons = document.querySelectorAll('[id^="icon-faq-"]');

    // Ferme toutes les autres FAQ
    allFaqs.forEach(faq => {
        if (faq.id !== faqId && faq.style.display === 'block') {
            faq.style.display = 'none';
        }
    });

    // Réinitialise tous les autres icônes
    allIcons.forEach(i => {
        if (i.id !== 'icon-' + faqId) {
            i.classList.remove('rotate-180');
        }
    });

    // Bascule l'état de la FAQ cliquée
    if (content.style.display === 'none') {
        content.style.display = 'block';
        icon.classList.add('rotate-180');
    } else {
        content.style.display = 'none';
        icon.classList.remove('rotate-180');
    }
}

// Ajoute une animation fluide
document.querySelectorAll('[id^="faq-"]').forEach(faq => {
    faq.style.transition = 'all 0.3s ease-in-out';
});
</script>
@endpush
@endsection 