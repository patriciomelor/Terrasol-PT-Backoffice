<?php
// app/Http/Controllers/LocationController.php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Comuna;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getRegion($regionNombre) // Cambiar $regionId a $regionNombre
    {
        $region = Region::where('nombre', $regionNombre)->first(); // Buscar por nombre

        if (!$region) {
            return response()->json(['message' => 'Región no encontrada', 'data' => []], 404); // 404 Not Found
        }

        return response()->json(['message' => 'Región encontrada', 'data' => $region], 200);
    }

    public function getComunas($regionNombre) // Cambiar $regionId a $regionNombre
    {
        $region = Region::where('nombre', $regionNombre)->first(); // Buscar por nombre

        if (!$region) {
            return response()->json(['message' => 'Región no encontrada', 'data' => []], 404); // 404 Not Found
        }

        $comunas = $region->comunas;

        if ($comunas->isEmpty()) {
            return response()->json(['message' => 'No hay comunas asociadas a esta región', 'data' => []], 200);
        }

        return response()->json(['message' => 'Comunas encontradas', 'data' => $comunas], 200);
    }

    public function getRegions()
    {
        $regions = Region::all();
        return response()->json(['message' => 'Regiones encontradas', 'data' => $regions], 200);
    }
}