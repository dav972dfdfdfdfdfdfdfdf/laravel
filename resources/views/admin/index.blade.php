<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">📰 Liste des actualités</h2>
            <button id="toggleFormBtn" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900 transition-colors shadow-md flex items-center">
        <span class="mr-2">➕</span> Nouvelle actualité
        </button>

        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Message de succès --}}
            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow border-l-4 border-green-500 flex items-center animate-fade-in-down">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Formulaire d'ajout (caché par défaut) --}}
            @include('admin.new')


            {{-- Card de recherche et filtres --}}
            <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            padding: 40px;
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: auto;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .input-wrapper {
            position: relative;
            flex-grow: 1;
            min-width: 250px;
        }

        .input-wrapper .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: gray;
        }

        .input-wrapper input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 16px;
        }

        .input-wrapper input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .search-button {
            background-color: #2563eb;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-button:hover {
            background-color: #1d4ed8;
        }

        .search-button:active {
            transform: scale(0.95);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
                align-items: stretch;
            }

            .search-button {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <form method="GET" action="#" class="search-form">
        <div class="input-wrapper">
            <span class="icon">🔍</span>
            <input type="text" name="search" placeholder="Rechercher une actualité...">
        </div>
        <button type="submit" class="search-button">
            🔍 Rechercher
        </button>
    </form>
</div>


                    </form>
                    <div class="mt-3 md:mt-0 flex items-center text-sm text-gray-500">
                        {{ $news->total() }} actualités trouvées
                    </div>
                </div>
            </div>

            {{-- Tableau des news --}}
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Créé le</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($news as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium max-w-xs break-words">
                                        {{ $item->titre }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                                        <div class="line-clamp-2">{{ $item->description }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="w-25 h-25 rounded-md overflow-hidden bg-gray-100">
                                            <img src="{{ $item->image }}" alt="Aperçu" class="w-full h-full object-cover">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-1">
                                        <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-2 sm:space-y-0">
                                            <a href="{{ route('admin.edit', $item->id) }}" 
                                                class="bg-amber-500 text-black px-3 py-1.5 rounded-md hover:bg-amber-600 transition-colors inline-flex items-center justify-center">
                                                <span class="mr-1">✏</span> Modifier
                                            </a>
                                            <form action="{{ route('admin.destroy', $item->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?')" 
                                                    class="bg-red-500 text-black px-3 py-1.5 rounded-md hover:bg-red-600 transition-colors inline-flex items-center justify-center w-full">
                                                    <span class="mr-1">🗑</span> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 01-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                            <p class="text-lg font-medium">Aucune actualité trouvée</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination améliorée --}}
                <div class="px-6 py-4 bg-gray-50">
                    {{ $news->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Script pour le toggle du formulaire --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleFormBtn = document.getElementById('toggleFormBtn');
            const cancelAddBtn = document.getElementById('cancelAddBtn');
            const addNewsForm = document.getElementById('addNewsForm');
            
            toggleFormBtn.addEventListener('click', function() {
                addNewsForm.classList.toggle('hidden');
                const isHidden = addNewsForm.classList.contains('hidden');
                if (!isHidden) {
                    document.getElementById('titre').focus();
                    toggleFormBtn.innerHTML = '<span class="mr-2">✖</span> Annuler';
                    toggleFormBtn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                    toggleFormBtn.classList.add('bg-gray-500', 'hover:bg-gray-600');
                } else {
                    toggleFormBtn.innerHTML = '<span class="mr-2">➕</span> Nouvelle actualité';
                    toggleFormBtn.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                    toggleFormBtn.classList.add('bg-blue-500', 'hover:bg-blue-600');
                }
            });
            
            cancelAddBtn.addEventListener('click', function() {
                addNewsForm.classList.add('hidden');
                toggleFormBtn.innerHTML = '<span class="mr-2">➕</span> Nouvelle actualité';
                toggleFormBtn.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                toggleFormBtn.classList.add('bg-blue-500', 'hover:bg-blue-600');
            });
        });
    </script>
</x-app-layout>