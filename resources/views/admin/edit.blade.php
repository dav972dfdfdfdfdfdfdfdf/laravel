<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 flex items-center gap-2">
                📝 Modifier une actualité
            </h2>
            <a href="{{ route('admin') }}" 
               class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                ← Retour
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-md">
                <form method="POST" action="{{ route('admin.update', $news->id) }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Titre -->
                    <div>
                        <label for="titre" class="block text-sm font-semibold text-gray-700 mb-1">Titre</label>
                        <input type="text" name="titre" id="titre" value="{{ old('titre', $news->titre) }}"
                               class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-400 transition"
                               placeholder="Entrez le titre..." required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="5"
                                  class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-400 transition"
                                  placeholder="Entrez la description..." required>{{ old('description', $news->description) }}</textarea>
                    </div>

                    <!-- Image -->
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-700">Image</label>

                        <div class="flex flex-col gap-4">
                            <!-- Option 1: URL de l'image -->
                            <div>
                                <input id="imageUrl" name="imageType" type="radio" value="url" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" checked>
                                <label for="imageUrl" class="ml-2 text-sm text-gray-700">Utiliser une URL</label>
                                <input type="url" name="image" id="imageUrlInput" value="{{ old('image', $news->image) }}"
                                       class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-400 transition"
                                       placeholder="https://..." required>
                            </div>

                           <!-- Aperçu -->
                           @if($news->image)
                            <div class="mt-4">
                                <p class="text-sm text-gray-500 mb-2">Aperçu actuel :</p>
                                <div class="relative flex items-center justify-center overflow-hidden rounded-md border border-gray-300 shadow-sm bg-gray-100" style="width: 200px; height: 100px;">
                                    <img src="{{ $news->image }}" alt="Aperçu de l'image" class="max-w-full max-h-full object-contain">
                                </div>
                            </div>
                        @endif

                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-4 pt-6">
                        <a href="{{ route('admin') }}" 
                           class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-700 rounded-md text-sm font-semibold hover:bg-gray-300 transition">
                            Annuler
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-yellow-400 hover:bg-yellow-500 text-black rounded-md text-sm font-semibold transition shadow-sm">
                            💾 Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
