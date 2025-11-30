@extends('layouts.app')

@section('titulo', 'Inicio')

@section('content')

<style>
    .home-container { max-width: 1200px; margin: 0 auto; padding: 20px; }
    
    /* Banner */
    .promo-banner {
        background-color: #A0A0A0;
        height: 300px;
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 40px;
        color: white; font-size: 40px; font-weight: bold;
    }
    
    /* Productos */
    .section-title { font-size: 20px; font-weight: 800; margin-bottom: 15px; color: #000; }
    
    .products-slider { display: flex; gap: 20px; overflow-x: auto; padding: 20px 0; }
    
    .product-card {
        background-color: #Eef7f9;
        min-width: 200px; height: 200px;
        border-radius: 50%;
        border: 4px dashed #fff; 
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .product-card img { width: 120px; height: auto; }
</style>

<div class="home-container">
    <div class="promo-banner">Promociones</div>

    <h2 class="section-title">Descubre lo nuevo...</h2>
    
    <div class="products-slider">
        {{-- Pon aquí tus imágenes --}}
        <div class="product-card"><img src="{{ asset('images/alimento.png') }}"></div>
        <div class="product-card"><img src="{{ asset('images/juguetes.png') }}"></div>
        <div class="product-card"><img src="{{ asset('images/ropa.png') }}"></div>
    </div>
</div>

@endsection