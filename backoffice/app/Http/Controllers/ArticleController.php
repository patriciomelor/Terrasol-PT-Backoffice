<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Feature;
use App\Models\Characteristic;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        foreach ($articles as $article) {
            $article->photos = json_decode($article->photos, true);
        }

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $features = Feature::all();
        $characteristics = Characteristic::all();
        return view('articles.create', compact('features', 'characteristics'));
    }

    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'title' => 'required|string',
            'cover_photo' => 'required|image',
            'photos.*' => 'nullable|image',
            'description' => 'required|string',
            'square_meters' => 'required|numeric',
            'constructed_meters' => 'nullable|numeric',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'sale_or_rent' => 'required|in:sale,rent',
            'characteristics' => 'nullable|array',
            'characteristics.*' => 'exists:characteristics,id',
        ]);
    
        // Crea un nuevo artículo
        $article = new Article();
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->square_meters = $request->input('square_meters');
        $article->constructed_meters = $request->input('constructed_meters');
        $article->region = $request->input('region');
        $article->city = $request->input('city');
        $article->street = $request->input('street');
        $article->sale_or_rent = $request->input('sale_or_rent');
    
        // Manejo de las fotos adicionales (si existen)
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $photos[] = $path;
            }
            $article->photos = json_encode($photos);
        }
    
        // Manejo de la foto de portada
        if ($request->hasFile('cover_photo')) {
            $coverPhotoPath = $request->file('cover_photo')->store('cover_photos', 'public');
            $article->cover_photo = $coverPhotoPath;
        }
    
        // Guarda el artículo
        $article->save();
    
        // Asocia las características seleccionadas (si existen)
        if ($request->has('characteristics')) {
            $article->characteristics()->sync($request->input('characteristics'));
        }
    
        return redirect()->route('articles.index')->with('success', 'Artículo creado exitosamente.');
    }
    
    
        
    public function show($id)
    {
        $article = Article::findOrFail($id);
        if (is_string($article->photos)) {
            $article->photos = json_decode($article->photos, true);
        }
        // Obtener las características asociadas al artículo
        $characteristics = $article->characteristics;
        // Obtener las características disponibles
        $features = Feature::all();
        $characteristics = Characteristic::all();

        return view('articles.show', compact('article', 'characteristics', 'features'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $features = Feature::all();
        $characteristics = Characteristic::all();
        return view('articles.edit', compact('article', 'features', 'characteristics'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string',
            'cover_photo' => 'required|image',
            'photos.*' => 'nullable|image',
            'description' => 'required|string',
            'square_meters' => 'required|numeric',
            'constructed_meters' => 'nullable|numeric',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'sale_or_rent' => 'required|in:sale,rent',
            'characteristics' => 'nullable|array',
            'characteristics.*' => 'exists:characteristics,id',
            
        ], [
            'characteristics.*.exists' => 'Algunas de las características seleccionadas no son válidas.',
        ]);
        
        // Actualiza los campos
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->square_meters = $request->input('square_meters');
        $article->constructed_meters = $request->input('constructed_meters');
        $article->region = $request->input('region');
        $article->city = $request->input('city');
        $article->street = $request->input('street');
        $article->sale_or_rent = $request->input('sale_or_rent');
        
        // Manejo de la foto de portada
        if ($request->hasFile('cover_photo')) {
            $coverPhotoPath = $request->file('cover_photo')->store('cover_photos', 'public');
            $article->cover_photo = $coverPhotoPath;
        }
    
        // Manejo de fotos adicionales
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('photos', 'public');
            }
            $article->photos = json_encode($photos);
        }
    
        // Guarda el artículo
        $article->save();
    
        // Asocia las características seleccionadas (si existen)
        if ($request->has('characteristics')) {
            $article->characteristics()->sync($request->input('characteristics'));
        } else {
            $article->characteristics()->detach();
        }
    
        return redirect()->route('articles.index')->with('success', 'Artículo actualizado exitosamente.');
    }
    
    

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artículo eliminado con éxito.');
    }
}
