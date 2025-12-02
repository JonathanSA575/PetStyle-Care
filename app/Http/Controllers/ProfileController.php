<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }
    // ... dentro de la clase ProfileController

    public function update(Request $request)
    {
        // 1. Validamos que lo que manden sea texto
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
        ]);

        // 2. Obtenemos al usuario conectado
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 3. Actualizamos sus datos
        $user->update([
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address
        ]);

        // 4. Lo regresamos con mensaje de éxito
        return redirect()->route('profile.index')->with('success', '¡Perfil actualizado con éxito!');
    }
    
    // Aquí luego agregaremos la función para guardar la dirección
}