<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $article = Article::findOrFail($id);
        $characteristics = Characteristic::all();
        $regions = Region::all();
        $comunas = Comuna::where('region_id', $article->region_id)->get();

        $article->photos = is_string($article->photos) ? json_decode($article->photos, true) : [];

        return view('articles.edit', compact('article', 'characteristics', 'regions', 'comunas'));
    }

    public function deletePhoto($id, $photo)
    {
        $article = Article::findOrFail($id);
        $photos = is_string($article->photos) ? json_decode($article->photos, true) : $article->photos;

        if (($key = array_search($photo, $photos)) !== false) {
            unset($photos[$key]);
        }

        $article->photos = json_encode(array_values($photos));
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
            'sale_or_rent' => 'required|in:Venta,Arriendo',
        ]);

        $article = new Article($request->only([
            'title', 'description', 'square_meters', 'constructed_meters', 'region', 'city', 'street', 'sale_or_rent'
        ]));

        if ($request->hasFile('cover_photo')) {
            $article->cover_photo = base64_encode(file_get_contents($request->file('cover_photo')->getRealPath()));
        }

        if ($request->hasFile('photos')) {
            $photos = array_map(function ($photo) {
                return base64_encode(file_get_contents($photo->getRealPath()));
            }, $request->file('photos'));
            $article->photos = json_encode($photos);
        }
       
    
        $article->save();

        if ($request->has('characteristics')) {
            $article->characteristics()->attach($request->input('characteristics'));
        }

        return redirect()->route('articles.index')->with('success', 'Artículo creado exitosamente.');
    }

    public function show($id)
    {
        $article = Article::with('region')->findOrFail($id);
        $article->photos = is_string($article->photos) ? json_decode($article->photos, true) : $article->photos;
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
            'title', 'description', 'square_meters', 'constructed_meters', 'region', 'city', 'street', 'sale_or_rent'
        ]));

        if ($request->hasFile('cover_photo')) {
            $article->cover_photo = base64_encode(file_get_contents($request->file('cover_photo')->getRealPath()));
        }

        if ($request->hasFile('photos')) {
            $photos = array_map(function ($photo) {
                return base64_encode(file_get_contents($photo->getRealPath()));
            }, $request->file('photos'));
            $article->photos = json_encode($photos);
        }

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

    public function apiIndex()
    {
        ini_set('memory_limit', '512M');

        $articles = Article::with('characteristics')->get()->each(function ($article) {
            $article->photos = is_string($article->photos) ? json_decode($article->photos, true) : $article->photos;
        });

        return response()->json([
            'status' => 'success',
            'data' => $articles,
        ], 200);
    }
}
