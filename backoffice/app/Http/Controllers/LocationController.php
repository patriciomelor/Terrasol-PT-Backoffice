<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    // Obtener todas las regiones de Chile
    public function getRegions()
    {
        $response = Http::get('https://apis.digital.gob.cl/dpa/regiones');
        return response()->json($response->json());
    }

    // Obtener las comunas según la región seleccionada
    public function getCommunes($regionId)
    {
        $response = Http::get("https://apis.digital.gob.cl/dpa/regiones/{$regionId}/comunas");
        return response()->json($response->json());
    }
}
