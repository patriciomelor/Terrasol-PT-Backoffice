<?php
// app/Http/Controllers/LocationController.php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Comuna;  // Asegúrate de que Comuna esté correctamente importado
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Método para obtener la región por ID
    public function getRegion($regionId)
    {
        $region = Region::find($regionId); // Busca la región por ID

        if (!$region) {
            return response()->json(['message' => 'Región no encontrada'], 404);
        }

        return response()->json($region); // Devuelve la región encontrada
    }

    // Método para obtener las comunas de una región específica
    public function getComunas($regionId)
    {
        $region = Region::find($regionId); // Busca la región por ID

        if (!$region) {
            return response()->json(['message' => 'Región no encontrada'], 404);
        }

        // Obtener las comunas asociadas
        $comunas = $region->comunas;  // Usando la relación definida en Region

        if ($comunas->isEmpty()) {
            return response()->json(['message' => 'No hay comunas asociadas a esta región'], 404);
        }

        return response()->json($comunas);  // Devuelve las comunas
    }
}
