<?php
namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Comuna; // O Commune si usas otro nombre para el modelo de ciudad


class LocationController extends Controller
{
    public function getRegions()
    {
        $regions = Region::all();
        return response()->json($regions);
    }

    public function getCommunes($regionId)
    {
        $region = Region::find($regionId);
        if (!$region) {
            return response()->json(['message' => 'Región no encontrada'], 404);
        }

        $communes = $region->comunas; // Usando la relación definida
        return response()->json($communes);
    }
}
