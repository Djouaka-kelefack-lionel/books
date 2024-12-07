<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; font-src 'self' https://cdnjs.cloudflare.com">
    <title>BiblioTech - Votre bibliothèque numérique</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hover-scale {
            transition: transform 0.2s;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold flex items-center space-x-2 hover:text-blue-200 transition">
                    <i class="fas fa-book-reader text-3xl"></i>
                    <span>BiblioTech</span>
                </a>
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-gray-200">
                        <i class="fas fa-home mr-1"></i>
                        Accueil
                    </a>
                    <a href="{{ route('books.index') }}" class="hover:text-gray-200">
                        <i class="fas fa-books mr-1"></i>
                        Bibliothèque
                    </a>
                    <a href="{{ route('books.create') }}" class="hover:text-gray-200">
                        <i class="fas fa-plus-circle mr-1"></i>
                        Ajouter un livre
                    </a>
                </div>
                <button class="md:hidden focus:outline-none" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        <!-- Menu mobile -->
        <div id="mobile-menu" class="hidden md:hidden absolute w-full bg-blue-700">
            <div class="container mx-auto px-4 py-2 space-y-2">
                <a href="{{ route('home') }}" class="block py-2 px-4 hover:bg-blue-600 rounded transition">
                    <i class="fas fa-home mr-2"></i> Accueil
                </a>
                <a href="{{ route('books.index') }}" class="block py-2 px-4 hover:bg-blue-600 rounded transition">
                    <i class="fas fa-books mr-2"></i> Bibliothèque
                </a>
                <a href="{{ route('books.create') }}" class="block py-2 px-4 hover:bg-blue-600 rounded transition">
                    <i class="fas fa-plus-circle mr-2"></i> Ajouter
                </a>
            </div>
        </div>
    </nav>

    <!-- Notifications -->
    @if(session('success') || session('error'))
    <div class="container mx-auto px-4 py-4">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded fade-in" role="alert">
                <p class="font-bold">Succès!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded fade-in" role="alert">
                <p class="font-bold">Erreur!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif
    </div>
    @endif

    <!-- Contenu principal -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">BiblioTech</h3>
                    <p class="text-gray-400">
                        Votre bibliothèque numérique gratuite pour partager et découvrir des livres au format PDF.
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('books.index') }}" class="text-gray-400 hover:text-white transition">Bibliothèque</a></li>
                        <li><a href="{{ route('books.create') }}" class="text-gray-400 hover:text-white transition">Ajouter un livre</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition">À propos</a></li>
                        <li><a href="#faq" class="text-gray-400 hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <p class="text-gray-400">
                        <a href="mailto:contact@bibliotech.com" class="hover:text-white transition">
                            <i class="fas fa-envelope mr-2"></i>contact@bibliotech.com
                        </a>
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('admin.login') }}" class="text-gray-400 text-sm hover:text-white transition">Administration</a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} BiblioTech. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    // Fermer le menu mobile lors du clic sur un lien
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    });

    // Fermer le menu mobile lors du clic en dehors
    document.addEventListener('click', (e) => {
        const menu = document.getElementById('mobile-menu');
        const menuButton = document.querySelector('button[onclick="toggleMobileMenu()"]');
        if (!menu.contains(e.target) && !menuButton.contains(e.target) && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
        }
    });
    </script>
</body>
</html> 