<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Importante para la base de datos

class ProductController extends Controller
{
    // Función para el Buscador
    public function buscar(Request $request)
    {
        // 1. Agarramos lo que escribió el usuario
        $busqueda = $request->input('query');

        // 2. Buscamos en la tabla 'productos'
        $productos = DB::table('productos')
                        ->where('nombre', 'LIKE', "%{$busqueda}%")
                        ->orWhere('descripcion', 'LIKE', "%{$busqueda}%")
                        ->orWhere('categoria', 'LIKE', "%{$busqueda}%")
                        ->get();

        // 3. Mandamos los resultados a la vista (crearemos esta vista después si no la tienes)
        return view('resultados', compact('productos', 'busqueda'));
    }
}