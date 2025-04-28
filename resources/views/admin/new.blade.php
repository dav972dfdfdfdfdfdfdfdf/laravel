<!-- resources/views/admin/new.blade.php -->

<div id="addNewsForm" class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 transition-all hidden">
    <h3 class="text-lg font-medium mb-4 border-b pb-2">Ajouter une nouvelle actualité</h3>
    <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="titre" class="block font-medium text-sm text-gray-700">Titre</label>
                <input type="text" name="titre" id="titre" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400 transition" required>
            </div>

            <div>
                <label for="image" class="block font-medium text-sm text-gray-700">URL de l'image</label>
                <input type="url" name="image" id="image" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400 transition" required>
            </div>
        </div>

        <div>
            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400 transition" required></textarea>
        </div>

        <div class="flex justify-end">
            <button type="button" id="cancelAddBtn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 mr-2 transition-colors">
                Annuler
            </button>
            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors shadow">
                ✅ Enregistrer
            </button>
        </div>
    </form>
</div>
