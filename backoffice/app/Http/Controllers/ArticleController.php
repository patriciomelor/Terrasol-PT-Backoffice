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
    
        // Convertir imágenes a Base64 si es necesario
        $articles->transform(function ($article) {
            if ($article->cover_photo) {
                $article->cover_photo = base64_encode(Storage::get($article->cover_photo));
            }
    
            if ($article->photos) {
                $photosArray = json_decode($article->photos, true);
                $article->photos = array_map(function ($photoPath) {
                    return base64_encode(Storage::get($photoPath));
                }, $photosArray);
            }
        // Decodificar las fotos si están en formato JSON
        $article->photos = is_string($article->photos) ? json_decode($article->photos, true) : $article->photos;
            
            return $article;
        });
    
        return view('articles.index', compact('articles')); // Muestra la vista en HTML
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
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->description = $request->input('description');

        // Foto de portada
        // En el controlador al guardar el artículo
        if ($request->hasFile('cover_photo')) {
            $article->cover_photo = base64_encode(file_get_contents($request->file('cover_photo')->getRealPath()));
        }

        // Fotos adicionales
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = base64_encode(file_get_contents($photo));
            }
            $article->photos = json_encode($photos);
        }

        $article->save();

        return redirect()->route('articles.index')->with('success', 'Artículo creado exitosamente.');
    }

        public function show($id)
        {
            $article = Article::findOrFail($id);
        
            // Decodificar las fotos si están en formato JSON
            $article->photos = is_string($article->photos) ? json_decode($article->photos, true) : $article->photos;
        
            // Obtener las características asociadas al artículo
            $characteristics = $article->characteristics;
        
            // Obtener todas las características disponibles
            $allCharacteristics = Characteristic::all();
        
            return view('articles.show', compact('article', 'characteristics', 'allCharacteristics'));
        }
    

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string',
            'cover_photo' => 'nullable|image',
            'photos.*' => 'nullable|image',
            'description' => 'required|string',
        ]);

        $article->update($request->only([
            'title', 'description', 'square_meters',
            'constructed_meters', 'region', 'city', 'street', 'sale_or_rent'
        ]));

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
