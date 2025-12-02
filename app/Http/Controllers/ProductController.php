<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <--- Importante: Esto conecta con la BD

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Iniciamos la consulta a la Base de Datos
        $query = Product::query();

        // 2. Aplicamos filtros si el usuario seleccionó algo
        
        // Filtro por Categoría
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filtro por Marca
        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand', $request->brand);
        }

        // 3. Ordenamiento
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc': $query->orderBy('price', 'asc'); break;
                case 'price_desc': $query->orderBy('price', 'desc'); break;
                case 'newest': $query->orderBy('created_at', 'desc'); break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // 4. Obtenemos los productos REALES de la BD (12 por página)
        $products = $query->paginate(8);

        // 5. Obtenemos listas para llenar los menús desplegables
        $categories = Product::select('category')->distinct()->pluck('category');
        $brands = Product::select('brand')->distinct()->whereNotNull('brand')->pluck('brand');

        return view('products.index', compact('products', 'categories', 'brands'));
    }

    public function show($sku)
    {
        // Buscar producto en la BD por SKU (o ID si prefieres)
        // Nota: Si usas ID en la ruta, cambia 'sku' por 'id'
        $productModel = Product::where('sku', $sku)->first();

        // Si no lo encuentra por SKU, intenta buscarlo por ID (para evitar errores)
        if (!$productModel) {
            $productModel = Product::find($sku);
        }

        // Si de plano no existe, error 404
        if (!$productModel) {
            abort(404);
        }

        // Preparamos los datos para la vista
        $product = (object)[
            'id' => $productModel->id,
            'sku' => $productModel->sku,
            'name' => $productModel->name,
            'subtitle' => $productModel->brand . ' - ' . $productModel->category,
            'price' => $productModel->price,
            'description' => $productModel->description,
            'image' => $productModel->image_path,
            'rating' => rand(3, 5), // Rating simulado
            'specs' => [
                'Marca' => $productModel->brand,
                'Categoría' => $productModel->category,
                'Stock' => $productModel->stock,
                'Tallas' => $productModel->sizes ? implode(', ', json_decode($productModel->sizes)) : 'N/A'
            ]
        ];

        return view('products.show', compact('product'));
    }
}