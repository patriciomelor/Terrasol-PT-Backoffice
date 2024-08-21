<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Importa el modelo correcto
use App\Models\Feature; // Importa el modelo Feature
use App\Models\Characteristic; 

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all(); // Obtener todos los artículos
        foreach ($articles as $article) {
            // Decodifica las rutas de las fotos si están en formato JSON
            $article->photos = json_decode($article->photos, true);
        }
        
        return view('articles.index', compact('articles')); // Pasar $articles a la vista
    }
    public function create()
    {
        $features = Feature::all(); // Obtener todas las características
        $characteristics = Characteristic::all();
        return view('articles.create', compact('characteristics'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'square_meters' => 'required|numeric',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'constructed_meters' => 'nullable|numeric',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'sale_or_rent' => 'required|in:sale,rent',
            'characteristics' => 'nullable|array',
            'characteristics.*' => 'boolean',
        ]);
    
        $article = new Article($request->except('photos', 'characteristics'));
    
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos');
                $photos[] = $path;
            }
            $article->photos = json_encode($photos);
        }
    
        $article->save();
    
        if ($request->has('characteristics')) {
            foreach ($request->characteristics as $id => $value) {
                $article->characteristics()->attach($id, ['value' => $value]);
            }
        }
    
        return redirect()->route('articles.index')->with('success', 'Artículo creado con éxito.');
    }
    
    
    
    public function show($id)
    {
        $article = Article::findOrFail($id);
        if (is_string($article->photos)) {
            $article->photos = json_decode($article->photos, true);
        }
        return view('articles.show', compact('article'));
    }
    
    
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);
    
        $article = Article::findOrFail($id);
        $article->update($request->all());
    
        return redirect()->route('articles.index');
    }
    
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
    
        return redirect()->route('articles.index');
    }
    
}