@extends('layouts.app')

@section('titulo', 'Aviso de Privacidad')

@section('content')
<div class="container py-5">
    
    <a href="{{ url('/') }}" class="btn text-white fw-bold px-4 py-2 rounded-3 mb-4" 
       style="background-color: #FF527B; border: none;">
        <i class="fa-solid fa-chevron-left me-2"></i> Regresar
    </a>

    <div class="p-5 rounded-4 bg-white shadow-sm border text-center">
        
        <img src="https://via.placeholder.com/150x60?text=Pet+Style" alt="Logo" class="mb-3">
        
        <h2 class="fw-bold mb-4" style="color: #004e64;">AVISO DE PRIVACIDAD</h2>

        <div class="text-start mx-auto" style="max-width: 800px;">
            <p class="text-muted">
                Programming is the process of creating instructions that a computer follows to perform specific tasks. 
                By writing code, programmers build applications, automate processes, and develop software that powers everything from websites to smartphones.
            </p>

            <h4 class="fw-bold mt-5 mb-3" style="color: #0097B2;">1. Datos personales recabados</h4>
            <p class="text-muted">
                Programming is the process of creating instructions that a computer follows to perform specific tasks. 
                By writing code, programmers build applications, automate processes, and develop software.
            </p>

            <h4 class="fw-bold mt-4 mb-3" style="color: #0097B2;">2. Finalidad del tratamiento</h4>
            <p class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>

    </div>
</div>
@endsection