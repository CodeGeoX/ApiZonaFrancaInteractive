<?php

namespace App\Http\Controllers;

use App\Models\Places_of_Interest;
use Illuminate\Http\Request;

class PlacesofInterestController extends Controller
{
    public function createPoint(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'long' => 'required',
            'lat' => 'required',
        ]);
        
        try {
            $user = $request->user(); // Asegúrate de que esto devuelve un objeto de usuario autenticado
            $placesofinterest = Places_of_Interest::create([
                'user_id' => $user->id, // Solo necesitas el ID del usuario
                'title' => $request['title'],
                'description' => $request['description'],
                'long' => $request['long'],
                'lat' => $request['lat'],
            ]);
    
            return response()->json([
                'status' => 'ok',
                'return' => $placesofinterest,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al registrar el punto de interés.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getUserPoints(Request $request)
    {
        try {
            $user = $request->user();
            $placesofinterest = $user->places_of_interests()->get(); 

            return response()->json([
                'status' => 'ok',
                'data' => $placesofinterest,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener los puntos de interés.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
