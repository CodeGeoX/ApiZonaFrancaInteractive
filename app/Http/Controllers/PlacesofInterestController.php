<?php

namespace App\Http\Controllers;

use App\Models\Places_of_Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlacesofInterestController extends Controller
{
    public function createPoint(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'long' => 'required',
        'lat' => 'required',
        'color' => 'required',  
        'image' => 'required|string', 
    ]);
    
    try {
        $user = $request->user(); 
        $isPublic = $user->role === 'admin';  

        $data = [
            'user_id' => $user->id,
            'title' => $request['title'],
            'description' => $request['description'],
            'long' => $request['long'],
            'lat' => $request['lat'],
            'is_public' => $isPublic,
            'color' => $request['color'],  
            'image_path' => $request['image'], // Almacenar el nombre de la imagen
        ];

        $point = Places_of_Interest::create($data);

        return response()->json([
            'status' => 'ok',
            'return' => $point,
            'id' => $point->id
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
            'image' => 'nullable|string',
        ]);

        $data = [
            'title' => $request['title'],
            'description' => $request['description'],
            'color' => $request['color'],
        ];

        if ($request->has('image')) {
            $imageData = $request->input('image');
            $image = base64_decode($imageData);
            $imageName = uniqid() . '.jpg';
            Storage::put('public/images/' . $imageName, $image);
            $data['image_path'] = 'storage/images/' . $imageName;
        }

        $place->update($data);

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


// Método para mostrar el punto de interés
public function showPoint($id)
{
    try {
        $point = Places_of_Interest::findOrFail($id);
        return response()->json([
            'status' => 'ok',
            'data' => $point,
        ], 200);
    } catch (\Exception $e) {
        \Log::error("Error retrieving point: " . $e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => 'Punto de interés no encontrado.',
            'error' => $e->getMessage(),
        ], 404);
    }
}

}