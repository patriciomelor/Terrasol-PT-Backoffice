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
    public function edit($id)
{
    $article = Article::findOrFail($id); // Encuentra el artículo por ID o muestra un error 404 si no existe
    $characteristics = Characteristic::all(); // Obtiene todas las características disponibles
     // Decodificar las fotos si están en formato JSON
     $article->photos = is_string($article->photos) ? json_decode($article->photos, true) : [];

     $features = Feature::all();
     $characteristics = Characteristic::all();
    return view('articles.edit', compact('article', 'characteristics')); // Pasa los datos a la vista
}
public function deletePhoto($id, $photo)
{
    $article = Article::findOrFail($id);

    // Decodificar las fotos actuales
    $photos = is_string($article->photos) ? json_decode($article->photos, true) : $article->photos;

    // Eliminar la foto del array
    if (($key = array_search($photo, $photos)) !== false) {
        unset($photos[$key]);
    }

    // Actualizar el campo de fotos en la base de datos
    $article->photos = json_encode(array_values($photos)); // Reindexar array
    $article->save();

    return redirect()->route('articles.show', $id)->with('success', 'Foto eliminada exitosamente.');
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
        ]);
    
        // Eliminar la imagen de portada si la casilla está marcada
        if ($request->has('delete_cover_photo')) {
            $article->cover_photo = null;
        }
    
        // Eliminar fotos adicionales marcadas para eliminar
        if ($request->has('delete_photos')) {
            $existingPhotos = is_string($article->photos) ? json_decode($article->photos, true) : [];
            $photosToDelete = $request->input('delete_photos');
    
            // Filtrar las fotos que no están en la lista de eliminación
            $remainingPhotos = array_filter($existingPhotos, function ($key) use ($photosToDelete) {
                return !in_array($key, $photosToDelete);
            }, ARRAY_FILTER_USE_KEY);
    
            $article->photos = json_encode(array_values($remainingPhotos)); // Reindexar el array
        }
    
        // Procesar foto de portada nueva, si existe
        if ($request->hasFile('cover_photo')) {
            $article->cover_photo = base64_encode(file_get_contents($request->file('cover_photo')->getRealPath()));
        }
    
        // Procesar fotos adicionales nuevas, si existen
        if ($request->hasFile('photos')) {
            $newPhotos = [];
            foreach ($request->file('photos') as $photo) {
                $newPhotos[] = base64_encode(file_get_contents($photo->getRealPath()));
            }
    
            // Combinar fotos nuevas con las existentes
            $existingPhotos = is_string($article->photos) ? json_decode($article->photos, true) : [];
            $article->photos = json_encode(array_merge($existingPhotos, $newPhotos));
        }
    
        $article->update($request->only([
            'title', 'description', 'square_meters', 'constructed_meters', 'region', 'city', 'street', 'sale_or_rent'
        ]));
    
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
