@extends('layouts.admin')

@section('title', 'Gestion des Catégories')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Formulaire d'ajout -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold mb-4">Ajouter une catégorie</h3>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                    Nom de la catégorie
                </label>
                <input type="text" 
                       name="name" 
                       id="name"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                    Description (optionnelle)
                </label>
                <textarea name="description" 
                          id="description"
                          rows="3"
                          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                Ajouter
            </button>
        </form>
    </div>

    <!-- Liste des catégories -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold mb-4">Liste des catégories</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nom
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Livres
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $category->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    {{ $category->description ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $category->books_count }} livres
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form action="{{ route('admin.categories.delete', $category) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="event.preventDefault(); showConfirmModal(
                                          '🗑️ Suppression d\'une catégorie',
                                          `📂 Catégorie : {{ $category->name }}
                                           📚 Nombre de livres : {{ $category->books_count }}
                                           
                                           @if($category->books_count > 0)
                                           ⛔ Cette catégorie contient des livres.
                                           Vous devez d'abord déplacer ou supprimer ces livres.
                                           @else
                                           ⚠️ Cette action est irréversible.
                                           @endif`,
                                          this
                                      );">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition duration-200 {{ $category->books_count > 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ $category->books_count > 0 ? 'disabled' : '' }}
                                            title="{{ $category->books_count > 0 ? 'Impossible de supprimer une catégorie contenant des livres' : 'Supprimer cette catégorie' }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection 