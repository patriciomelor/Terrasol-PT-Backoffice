<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use App\Models\Feature;
use App\Models\Characteristic;
use App\Models\Region;
use App\Models\Comuna; 

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
    $regions = Region::all(); // Para el select de regiones
    $comunas = Comuna::where('region_id', $article->region_id)->get(); // Obtener las comunas de la región

    $article->photos = is_string($article->photos) ? json_decode($article->photos, true) : [];

     $features = Feature::all();
     $characteristics = Characteristic::all();
    return view('articles.edit', compact('article', 'characteristics','regions', 'comunas')); // Pasa los datos a la vista
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
            'square_meters' => 'required|numeric',
            'constructed_meters' => 'nullable|numeric',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'sale_or_rent' => 'required|in:sale,rent',
            'characteristics' => 'nullable|array',
            'characteristics.*' => 'exists:characteristics,id',
        ]);
    
        // Actualizar los atributos del artículo
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->square_meters = $request->input('square_meters');
        $article->constructed_meters = $request->input('constructed_meters');
        $article->region = $request->input('region');
        $article->city = $request->input('city');
        $article->street = $request->input('street');
        $article->sale_or_rent = $request->input('sale_or_rent');
    
        // Actualizar foto de portada si es necesario
        if ($request->hasFile('cover_photo')) {
            $article->cover_photo = base64_encode(file_get_contents($request->file('cover_photo')->getRealPath()));
        }
    
        // Actualizar fotos adicionales
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = base64_encode(file_get_contents($photo->getRealPath()));
            }
            $article->photos = json_encode($photos);
        }
    
        // Actualizar características
        if ($request->has('characteristics')) {
            $article->characteristics()->sync($request->input('characteristics'));
        } else {
            $article->characteristics()->detach();
        }
    
        $article->save();
    
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
        ini_set('memory_limit', '512M'); // Aumenta el límite de memoria a 256 MB
        
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
