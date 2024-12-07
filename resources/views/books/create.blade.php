@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <!-- En-tête -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-12 px-6 rounded-lg mb-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Ajouter un livre</h1>
        <p class="text-lg text-blue-100">Partagez un livre avec la communauté</p>
    </div>

    <!-- Affichage des erreurs -->
    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <h3 class="font-semibold">Erreurs lors de l'ajout du livre :</h3>
            </div>
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @if($errors->has('character_error'))
                <div class="mt-4 p-4 bg-yellow-100 rounded">
                    <p class="font-semibold">Caractères autorisés :</p>
                    <ul class="list-disc list-inside text-sm mt-2">
                        <li>Lettres (a-z, A-Z) et accents</li>
                        <li>Chiffres (0-9)</li>
                        <li>Espaces</li>
                        <li>Caractères spéciaux : - _ ' " & ( ) [ ] { } . , ; : ! ?</li>
                    </ul>
                </div>
            @endif
        </div>
    @endif

    <!-- Formulaire -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Titre -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                    Titre <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}" 
                           class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                  @error('title') border-red-500 bg-red-50 @enderror"
                           placeholder="Entrez le titre du livre">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-book text-gray-400"></i>
                    </div>
                </div>
                @error('title')
                    <div class="mt-1 flex items-center text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Auteur -->
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-1">
                    Auteur <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="text" 
                           name="author" 
                           id="author" 
                           value="{{ old('author') }}"
                           class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                  @error('author') border-red-500 bg-red-50 @enderror"
                           placeholder="Nom de l'auteur">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                </div>
                @error('author')
                    <div class="mt-1 flex items-center text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Catégorie -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Catégorie <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select name="category_id" 
                            id="category_id" 
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                   @error('category_id') border-red-500 bg-red-50 @enderror">
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-folder text-gray-400"></i>
                    </div>
                </div>
                @error('category_id')
                    <div class="mt-1 flex items-center text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4" 
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                 @error('description') border-red-500 bg-red-50 @enderror"
                          placeholder="Décrivez le livre en quelques phrases">{{ old('description') }}</textarea>
                @error('description')
                    <div class="mt-1 flex items-center text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Fichier PDF -->
            <div>
                <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-1">
                    Fichier PDF <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg
                            @error('pdf_file') border-red-500 bg-red-50 @enderror">
                    <div class="space-y-1 text-center">
                        <i class="fas fa-file-pdf text-4xl text-gray-400 mb-3"></i>
                        <div class="flex text-sm text-gray-600">
                            <label for="pdf_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Sélectionner un fichier</span>
                                <input id="pdf_file" name="pdf_file" type="file" class="sr-only" accept=".pdf">
                            </label>
                            <p class="pl-1">ou glisser-déposer</p>
                        </div>
                        <p class="text-xs text-gray-500">PDF jusqu'à 10MB</p>
                    </div>
                </div>
                @error('pdf_file')
                    <div class="mt-1 flex items-center text-sm text-red-600">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Légende des champs obligatoires -->
            <div class="text-sm text-gray-500">
                <span class="text-red-500">*</span> Champs obligatoires
            </div>

            <!-- Boutons -->
            <div class="flex justify-between pt-4">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Annuler
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Ajouter le livre
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 