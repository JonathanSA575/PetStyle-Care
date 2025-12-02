<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Mostrar el carrito (Página 4 PDF)
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    // Agregar producto al carrito
    public function add(Request $request, $id)
    {
        $product = Product::where('sku', $id)->firstOrFail();
        $cart = session()->get('cart', []);

        // Si el producto ya está, aumentamos la cantidad
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Si no está, lo agregamos
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_path,
                "sku" => $product->sku,
                "size" => $request->input('size', 'Unítalla'), // Talla seleccionada
                "color" => $request->input('color', 'Único')   // Color seleccionado
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Producto agregado con éxito');
    }
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            
            // Actualizamos la cantidad
            $cart[$request->id]["quantity"] = $request->quantity;
            
            // Guardamos de nuevo en la sesión
            session()->put('cart', $cart);
            
            session()->flash('success', 'Carrito actualizado correctamente');
        }
    }

    // Eliminar producto
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back();
        }
    }
}