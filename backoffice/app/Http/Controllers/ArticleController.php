<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Feature;
use App\Models\Characteristic;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
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
        ]);
    
        $article = new Article();
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->square_meters = $request->input('square_meters');
        $article->constructed_meters = $request->input('constructed_meters');
        $article->region = $request->input('region');
        $article->city = $request->input('city');
        $article->street = $request->input('street');
        $article->sale_or_rent = $request->input('sale_or_rent');
    
        // Almacenar foto de portada como base64 en la base de datos
        if ($request->hasFile('cover_photo')) {
            $article->cover_photo = base64_encode(file_get_contents($request->file('cover_photo')->getRealPath()));
        }
    
        // Almacenar fotos adicionales como un array codificado en base64
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = base64_encode(file_get_contents($photo->getRealPath()));
            }
            $article->photos = json_encode($photos); // Guardar como JSON en la base de datos
        }
    
        $article->save();
    
        return redirect()->route('articles.index')->with('success', 'Artículo creado exitosamente.');
    }
    
    public function show($id)
    {
        $article = Article::findOrFail($id);
        
        // Decodificar las fotos si están en formato JSON
        $article->photos = is_string($article->photos) ? json_decode($article->photos, true) : $article->photos;

        // Obtener todas las características y las asociadas al artículo
        $allCharacteristics = Characteristic::all();

        return view('articles.show', compact('article', 'allCharacteristics'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string',
            'cover_photo' => 'nullable|image',
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

        $article->update($request->only([
            'title', 'description', 'square_meters',
            'constructed_meters', 'region', 'city', 'street', 'sale_or_rent'
        ]));

        // Actualizar la foto de portada si es necesario
        if ($request->hasFile('cover_photo')) {
            $article->cover_photo = base64_encode(file_get_contents($request->file('cover_photo')->getRealPath()));
        }

        // Actualizar las fotos adicionales
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = base64_encode(file_get_contents($photo));
            }
            $article->photos = json_encode($photos);
        }

        // Sincronizar características
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

        return redirect()->route('articles.index')->with('success', 'Artículo eliminado exitosamente.');
    }

    // Método solo para la API
    public function apiIndex()
    {
        $articles = Article::with('characteristics')->get();

        foreach ($articles as $article) {
            // Decodificar las fotos si están en formato JSON
            $article->photos = is_string($article->photos) ? json_decode($article->photos, true) : $article->photos;
        }

        return response()->json([
            'status' => 'success',
            'data' => $articles,
        ], 200);
    }
}
