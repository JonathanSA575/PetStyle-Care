@extends('layouts.app')

@section('titulo', 'Mi Cuenta')

@section('contenido')

<style>
    .dashboard-container {
        max-width: 900px;
        margin: 60px auto;
        padding: 20px;
        font-family: 'Nunito', sans-serif;
    }
    .welcome-card {
        background-color: #EEF7F9; /* Azulito hielo */
        padding: 50px;
        border-radius: 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid #e1e8ed;
    }
    .welcome-card h1 {
        color: #005F73; /* Azul petróleo */
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 15px;
    }
    .welcome-card p {
        color: #555;
        font-size: 20px;
        margin-bottom: 30px;
        font-weight: 600;
    }
    .btn-tienda {
        background-color: #FF527B; /* Rosa */
        color: white;
        text-decoration: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 18px;
        transition: transform 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 5px 15px rgba(255, 82, 123, 0.3);
    }
    .btn-tienda:hover {
        background-color: #ff3363;
        transform: scale(1.05);
        color: white;
    }
    .user-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #0097B2;
        margin-bottom: 20px;
    }
</style>

<div class="dashboard-container">
    <div class="welcome-card">
        
        {{-- Muestra la foto de Google si existe --}}
        @if(Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" alt="Perfil" class="user-avatar">
        @else
            <i class="fa-regular fa-circle-user" style="font-size: 80px; color: #0097B2; margin-bottom: 20px;"></i>
        @endif
        
        <h1>¡Hola, {{ Auth::user()->name }}! 👋</h1>
        
        <p>Has iniciado sesión correctamente como <strong>Cliente</strong>.</p>
        <p>Bienvenido a la familia PetStyle & Care.</p>

        <a href="/" class="btn-tienda">
            <i class="fa-solid fa-store"></i> Ir a la Tienda
        </a>
    </div>
</div>

@endsection