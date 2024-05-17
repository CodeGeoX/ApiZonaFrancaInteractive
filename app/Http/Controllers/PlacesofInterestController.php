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
            'color' => 'required',  // Validación del campo color
        ]);
        
        try {
            $user = $request->user(); 
            $isPublic = $user->role === 'admin';  

            $placesofinterest = Places_of_Interest::create([
                'user_id' => $user->id,
                'title' => $request['title'],
                'description' => $request['description'],
                'long' => $request['long'],
                'lat' => $request['lat'],
                'is_public' => $isPublic,
                'color' => $request['color'],  
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
            
            $placesofinterest = Places_of_Interest::where('user_id', $user->id)
                               ->orWhere('is_public', true)  
                               ->get(); 
    
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
    public function deletePoint(Request $request, $id)
    {
        try {
            $user = $request->user(); 
            
            $place = $user->places_of_interests()->findOrFail($id);

            $place->delete();

            return response()->json([
                'status' => 'ok',
                'message' => 'Punto de interés eliminado exitosamente.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el punto de interés.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function updatePoint(Request $request, $id)
    {
        try {
            $user = $request->user(); 
            
            $place = $user->places_of_interests()->findOrFail($id);

            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'color' => 'required',  
            ]);

            $place->update([
                'title' => $request['title'],
                'description' => $request['description'],
                'color' => $request['color'],  
            ]);

            return response()->json([
                'status' => 'ok',
                'message' => 'Punto de interés actualizado exitosamente.',
                'data' => $place, 
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el punto de interés.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}