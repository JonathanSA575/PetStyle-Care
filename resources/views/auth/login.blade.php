@extends('layouts.app')

@section('content')

{{-- FUENTE NUNITO --}}
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">

<style>
    nav, header, footer { display: none !important; }

    body {
        font-family: 'Nunito', sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        /* Asegúrate de tener esta imagen en public/images/ */
        background: url("{{ asset('images/fondo-login.png') }}") no-repeat center center fixed; 
        background-size: cover;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-wrapper {
        width: 100%;
        max-width: 450px;
        text-align: center;
        padding: 40px;
        background-color: rgba(255, 255, 255, 0.95); 
        border-radius: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .logo-img { width: 220px; margin-bottom: 20px; }

    /* INPUTS (Bordes redondos y azules) */
    .custom-input {
        width: 100%;
        padding: 12px 20px;
        border: 2px solid #0097B2; 
        border-radius: 50px; 
        font-size: 16px;
        color: #555;
        outline: none;
        margin-bottom: 20px;
        box-sizing: border-box;
        font-weight: 600;
        background-color: white;
        text-align: center; /* Texto centrado como en tu diseño */
    }
    .custom-input::placeholder { color: #aaa; font-weight: 500; }

    /* BOTÓN INICIAR SESIÓN (Rosa y gordito) */
    .btn-login {
        width: 60%;
        padding: 12px;
        background-color: #FF85B3; 
        color: white;
        border: none;
        border-radius: 50px;
        font-size: 18px;
        font-weight: 900;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(255, 133, 179, 0.4);
        transition: transform 0.2s;
        display: block;
        margin: 10px auto 15px auto; 
    }
    .btn-login:hover { transform: scale(1.05); }

    /* Separador */
    .separator { font-weight: 900; margin: 10px 0; font-size: 14px; }

    /* BOTÓN GOOGLE (Gris con icono) */
    .btn-google {
        width: 80%;
        padding: 10px;
        background-color: #E0E0E0; /* Gris claro */
        color: #333;
        border: none;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin: 0 auto;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-google:hover { background-color: #d6d6d6; }

    /* Manejo de errores visual */
    .error-msg { color: red; font-size: 12px; margin-top: -15px; margin-bottom: 15px; }
</style>

<div class="login-wrapper">
    
    <img src="{{ asset('images/logo.png') }}" alt="PetStyle Logo" class="logo-img">

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input id="correo_electronico" type="email" class="custom-input" 
               name="correo_electronico" required autocomplete="email" autofocus
               placeholder="Correo electrónico">

        @error('correo_electronico')
            <div class="error-msg"><strong>{{ $message }}</strong></div>
        @enderror

        <input id="password" type="password" class="custom-input" 
               name="password" required
               placeholder="Contraseña"> {{-- A tu diseño le faltaba el input visual de contraseña, pero es obligatorio --}}

        @error('password')
            <div class="error-msg"><strong>{{ $message }}</strong></div>
        @enderror

        <button type="submit" class="btn-login">Iniciar sesión</button>
    </form>

    <div class="separator">o</div>

    {{-- BOTÓN FUNCIONAL CONECTADO A LA RUTA --}}
   {{-- BOTÓN GOOGLE (Con icono SVG incrustado para que no falle nunca) --}}
    <a href="{{ route('google.login') }}" class="btn-google" style="text-decoration: none;">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48" class="google-icon">
            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
        </svg>
        <span style="margin-left: 10px;">Continuar con Google</span>
    </a>

</div>
@endsection