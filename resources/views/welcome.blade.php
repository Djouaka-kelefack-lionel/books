@extends('layouts.app')

@section('content')
<!-- Hero Section avec fond animé -->
<div class="relative bg-gradient-to-r from-blue-600 to-blue-800 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-800 opacity-90"></div>
        <div class="absolute inset-0 bg-pattern"></div>
    </div>
    <div class="relative container mx-auto px-4 py-24">
        <div class="max-w-3xl mx-auto text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">
                Découvrez et Partagez des Livres
            </h1>
            <p class="text-xl md:text-2xl mb-12 text-blue-100">
                Votre bibliothèque numérique collaborative, gratuite et accessible à tous
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('books.index') }}" 
                   class="px-8 py-4 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition duration-200 hover-scale">
                    <i class="fas fa-search mr-2"></i>
                    Explorer la bibliothèque
                </a>
                <a href="{{ route('books.create') }}" 
                   class="px-8 py-4 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-400 transition duration-200 hover-scale">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Contribuer
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Section Caractéristiques -->
<div class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Pourquoi choisir BiblioTech ?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg hover-scale">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-book-open text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Bibliothèque Gratuite</h3>
                <p class="text-gray-600">
                    Accédez à une vaste collection de livres numériques gratuitement et sans inscription.
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover-scale">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-share-alt text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Partage Facile</h3>
                <p class="text-gray-600">
                    Partagez vos livres préférés avec la communauté en quelques clics.
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover-scale">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-comments text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Communauté Active</h3>
                <p class="text-gray-600">
                    Échangez avec d'autres lecteurs à travers les commentaires et les likes.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Section Statistiques -->
<div class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ $totalBooks }}</div>
                <div class="text-gray-600">Livres disponibles</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-green-600 mb-2">{{ $totalCategories }}</div>
                <div class="text-gray-600">Catégories</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-red-600 mb-2">{{ $totalLikes }}</div>
                <div class="text-gray-600">Likes</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-purple-600 mb-2">{{ $totalDownloads }}</div>
                <div class="text-gray-600">Téléchargements</div>
            </div>
        </div>
    </div>
</div>

<!-- Section Derniers Livres -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Derniers ajouts</h2>
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
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
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
                            <div class="flex items-center space-x-4">
                                <span title="Likes" class="text-gray-600">
                                    <i class="fas fa-heart text-red-500"></i>
                                    {{ $book->likes_count }}
                                </span>
                                <span title="Commentaires" class="text-gray-600">
                                    <i class="fas fa-comment text-blue-500"></i>
                                    {{ $book->comments_count }}
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

<!-- Section FAQ -->
<div id="faq" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Questions fréquentes</h2>
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

    allFaqs.forEach(faq => {
        if (faq.id !== faqId && faq.style.display === 'block') {
            faq.style.display = 'none';
        }
    });

    allIcons.forEach(i => {
        if (i.id !== 'icon-' + faqId) {
            i.classList.remove('rotate-180');
        }
    });

    if (content.style.display === 'none') {
        content.style.display = 'block';
        icon.classList.add('rotate-180');
    } else {
        content.style.display = 'none';
        icon.classList.remove('rotate-180');
    }
}
</script>
@endpush
@endsection 