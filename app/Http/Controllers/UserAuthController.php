<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (User::where('email', $validatedData['email'])->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'El correo electrónico ya está registrado. Por favor, usa otro correo.',
            ], 409); 
        }
        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);

            $token = $user->createToken('appToken')->plainTextToken;

            return response()->json([
                'status' => 'ok',
                'token' => $token,
                'name' => $user->name,
                'email' =>$user->email,
                'password' =>$user->password,
                'user_id' => $user->id,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al registrar el usuario.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            $token = $user->createToken('NombreDelToken')->plainTextToken;
    
            return response()->json([
                'status' => 'ok',
                'token' => $token,
                'name' => $user->name,
                'user_id' => $user->id, 
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Credenciales no válidas',
        ], 401);
    }

    public function updateadmin(Request $request, $id)
{
    try {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'role' => 'required',
            
        ]);
        $user->role = $validatedData['role'];
        $user->save();  

        return response()->json([
            'status' => 'ok',
            'message' => 'Usuario actualizado correctamente',
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error al actualizar el usuario',
            'error' => $e->getMessage(),
        ], 500);
    }
}

}
