<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Importa el modelo correcto

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
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'square_meters' => 'nullable|integer',
            'constructed_meters' => 'nullable|integer',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'sale_or_rent' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image',
        ]);
    
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->square_meters = $request->square_meters;
        $article->constructed_meters = $request->constructed_meters;
        $article->region = $request->region;
        $article->city = $request->city;
        $article->street = $request->street;
        $article->sale_or_rent = $request->sale_or_rent;
        
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('photos');
            }
            $article->photos = json_encode($photos);
        }
    
        $article->save();
    
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