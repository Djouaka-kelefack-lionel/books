@extends('layouts.admin')

@section('title', 'Gestion des FAQs')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Formulaire d'ajout -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-lg font-semibold mb-6 flex items-center">
            <i class="fas fa-plus-circle text-blue-500 mr-2"></i>
            Ajouter une FAQ
        </h3>
        <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="question" class="block text-sm font-medium text-gray-700 mb-1">
                    Question
                </label>
                <input type="text" 
                       name="question" 
                       id="question"
                       value="{{ old('question') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                              @error('question') border-red-500 @enderror"
                       required>
                @error('question')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="answer" class="block text-sm font-medium text-gray-700 mb-1">
                    Réponse
                </label>
                <textarea name="answer" 
                          id="answer"
                          rows="4"
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                 @error('answer') border-red-500 @enderror"
                          required>{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-1">
                    Ordre d'affichage
                </label>
                <input type="number" 
                       name="order" 
                       id="order"
                       value="{{ old('order', 0) }}"
                       min="0"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                              @error('order') border-red-500 @enderror">
                @error('order')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-save mr-2"></i>
                Ajouter
            </button>
        </form>
    </div>

    <!-- Liste des FAQs -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-6 flex items-center">
                <i class="fas fa-list text-blue-500 mr-2"></i>
                Liste des FAQs
            </h3>
            
            <div class="space-y-4">
                @forelse($faqs as $faq)
                    <div class="border rounded-lg overflow-hidden" id="faq-{{ $faq->id }}">
                        <!-- En-tête FAQ -->
                        <div class="bg-gray-50 p-4 flex justify-between items-start">
                            <div>
                                <h4 class="font-medium">{{ $faq->question }}</h4>
                                <p class="text-sm text-gray-500 mt-1">Ordre : {{ $faq->order }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="toggleEdit({{ $faq->id }})" 
                                        class="text-blue-600 hover:text-blue-800 transition duration-200">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.faqs.delete', $faq) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="event.preventDefault(); showConfirmModal(
                                          '🗑️ Suppression d\'une FAQ',
                                          `❓ Question : {{ $faq->question }}
                                           📝 Réponse : {{ Str::limit($faq->answer, 100) }}
                                           🔢 Ordre d'affichage : {{ $faq->order }}
                                           
                                           ⚠️ Cette action est irréversible.`,
                                          this
                                      );">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition duration-200"
                                            title="Supprimer cette FAQ">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Contenu FAQ -->
                        <div class="p-4 border-t">
                            <p class="text-gray-600">{{ $faq->answer }}</p>
                        </div>

                        <!-- Formulaire d'édition (caché par défaut) -->
                        <div id="edit-form-{{ $faq->id }}" class="hidden border-t p-4 bg-gray-50">
                            <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                                    <input type="text" 
                                           name="question" 
                                           value="{{ $faq->question }}"
                                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                           required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Réponse</label>
                                    <textarea name="answer" 
                                              rows="3"
                                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                              required>{{ $faq->answer }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Ordre</label>
                                    <input type="number" 
                                           name="order" 
                                           value="{{ $faq->order }}"
                                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button type="button" 
                                            onclick="toggleEdit({{ $faq->id }})"
                                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-200">
                                        Annuler
                                    </button>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200">
                                        Mettre à jour
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-question-circle text-4xl mb-4"></i>
                        <p>Aucune FAQ n'a été créée pour le moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $faqs->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleEdit(id) {
    const form = document.getElementById(`edit-form-${id}`);
    form.classList.toggle('hidden');
}
</script>
@endpush
@endsection 