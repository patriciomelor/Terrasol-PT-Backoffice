<?php
// app/Http/Controllers/LocationController.php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Comuna;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getRegion($regionId)
    {
        $region = Region::find($regionId);

        if (!$region) {
            return response()->json(['message' => 'Región no encontrada', 'data' => []], 200);
        }

        return response()->json(['message' => 'Región encontrada', 'data' => $region], 200);
    }

    public function getComunas($regionId)
    {
        $region = Region::find($regionId);

        if (!$region) {
            return response()->json(['message' => 'Región no encontrada', 'data' => []], 200);
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