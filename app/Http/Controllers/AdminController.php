<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('titre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $news = $query->latest()->paginate(10);

        return view('admin.index', compact('news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',  // corrigé ici
            'description' => 'required|string',
            'image' => 'required|url'
        ]);

        News::create($request->only(['titre', 'description', 'image']));

        return redirect()->route('admin')->with('success', 'News ajoutée avec succès !');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('admin')->with('success', 'News supprimée avec succès !');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255', // corrigé ici aussi
            'description' => 'required|string',
            'image' => 'required|url'
        ]);

        $news = News::findOrFail($id);
        $news->update($request->only(['titre', 'description', 'image']));

        return redirect()->route('admin')->with('success', 'News mise à jour avec succès !');
    }
}
