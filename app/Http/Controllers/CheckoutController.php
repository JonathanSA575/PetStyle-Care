<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Verificamos que haya algo en el carrito
        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return redirect()->route('products.index');
        }

        // Calculamos total
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        // AQUÍ IRÍA LA LÓGICA PARA GUARDAR LA ORDEN EN LA BASE DE DATOS
        // Por ahora, solo simulamos éxito y borramos el carrito.

        session()->forget('cart');

        return redirect()->route('products.index')->with('status', '¡Pedido realizado con éxito! Gracias por tu compra.');
    }
}