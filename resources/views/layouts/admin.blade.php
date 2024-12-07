<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - BiblioTech</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar Mobile Toggle -->
        <button onclick="toggleSidebar()" 
                class="lg:hidden fixed bottom-4 right-4 z-50 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <div id="sidebar" 
             class="bg-gray-800 text-white w-64 py-6 flex flex-col min-h-screen fixed lg:relative lg:translate-x-0 transform -translate-x-full lg:transform-none transition-transform duration-200 z-40">
            <div class="px-6 mb-8 flex justify-between items-center">
                <h1 class="text-2xl font-bold">BiblioTech Admin</h1>
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="flex-1 px-3 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.books') }}" 
                   class="flex items-center px-3 py-2 rounded-lg mb-2 {{ request()->routeIs('admin.books*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-book w-6"></i>
                    <span>Livres</span>
                </a>
                <a href="{{ route('admin.categories') }}" 
                   class="flex items-center px-3 py-2 rounded-lg mb-2 {{ request()->routeIs('admin.categories*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-folder w-6"></i>
                    <span>Catégories</span>
                </a>
                <a href="{{ route('admin.comments') }}" 
                   class="flex items-center px-3 py-2 rounded-lg mb-2 {{ request()->routeIs('admin.comments*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-comments w-6"></i>
                    <span>Commentaires</span>
                </a>
                <a href="{{ route('admin.faqs') }}" 
                   class="flex items-center px-3 py-2 rounded-lg mb-2 {{ request()->routeIs('admin.faqs*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-question-circle w-6"></i>
                    <span>FAQs</span>
                </a>
            </nav>
            <div class="mt-auto px-3 py-4 border-t border-gray-700">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg transition duration-200 flex items-center justify-center group">
                        <i class="fas fa-sign-out-alt mr-2 transform group-hover:-translate-x-1 transition-transform duration-200"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Overlay pour mobile -->
        <div id="sidebar-overlay" 
             onclick="toggleSidebar()"
             class="fixed inset-0 bg-black opacity-50 z-30 lg:hidden hidden"></div>

        <!-- Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="bg-white shadow-sm sticky top-0 z-20">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">
                            @yield('title', 'Dashboard')
                        </h2>
                        <!-- Boutons d'action spécifiques à chaque page -->
                        <div class="flex items-center space-x-4">
                            @yield('actions')
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
    <script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        
        // Empêcher le défilement du body quand la sidebar est ouverte sur mobile
        document.body.classList.toggle('overflow-hidden', !sidebar.classList.contains('-translate-x-full'));
    }

    // Fermer la sidebar si la fenêtre est redimensionnée au-dessus du breakpoint mobile
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) { // 1024px est le breakpoint lg de Tailwind
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
    </script>

    <!-- Modal de confirmation -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 transform transition-all">
            <div class="text-center">
                <div class="mb-4">
                    <i id="modalIcon" class="fas fa-exclamation-triangle text-4xl text-yellow-500"></i>
                </div>
                <h3 id="modalTitle" class="text-xl font-bold text-gray-900 mb-4"></h3>
                <p id="modalMessage" class="text-gray-600 mb-8 whitespace-pre-line"></p>
                <div class="flex justify-center space-x-4">
                    <button onclick="closeConfirmModal()" 
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-200">
                        Annuler
                    </button>
                    <button id="confirmButton"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition duration-200">
                        Confirmer la suppression
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ajouter le script pour gérer la modale -->
    <script>
    let currentForm = null;

    function showConfirmModal(title, message, form) {
        currentForm = form;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalMessage').textContent = message;
        document.getElementById('confirmModal').classList.remove('hidden');
        document.getElementById('confirmModal').classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
        document.getElementById('confirmModal').classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        currentForm = null;
    }

    document.getElementById('confirmButton').addEventListener('click', function() {
        if (currentForm) {
            currentForm.submit();
        }
    });

    // Fermer la modale si on clique en dehors
    document.getElementById('confirmModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirmModal();
        }
    });
    </script>
</body>
</html> 