@extends('layouts.app')

@section('titulo', $service->name)

@section('content')

@php
    // 1. Definimos los colores
    $colors = [
        'spa' => '#004e64',
        'estetica' => '#9D7AD2',
        'paseo' => '#0097B2',
    ];
    $bgColor = $colors[$service->slug] ?? '#004e64';

    // 2. Corrección para asegurar que sea una lista (Array) y no truene
    $listaAddons = $service->addons;
    
    if (is_string($listaAddons)) {
        $listaAddons = json_decode($listaAddons, true);
    }
    
    if (!is_array($listaAddons)) {
        $listaAddons = [];
    }
@endphp

<div class="container py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #000;">{{ $service->name }}</h2>
    </div>

    <div class="row shadow-lg rounded-4 overflow-hidden bg-white">
        
        <div class="col-md-5 p-0 position-relative">
            <img src="{{ $service->image_path }}" class="w-100 h-100 object-fit-cover" style="min-height: 500px;">
            <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-white bg-opacity-90">
                <h5 class="fw-bold mb-2">Información importante</h5>
                <p class="small text-muted mb-0">{{ $service->description }}</p>
            </div>
        </div>

        <div class="col-md-7 p-5" style="background-color: {{ $bgColor }}; color: white;">
            
            <h4 class="mb-4 fw-bold">Marca las casillas de nuestros servicios que te parezcan adecuadas</h4>

            <form action="#" method="POST">
                @csrf
                <div class="d-flex flex-column gap-3">
                    
                    @foreach($listaAddons as $index => $addon)
                    
                    <div class="addon-item p-3 rounded-3" 
                         style="background-color: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;">
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-grow-1">
                                <input class="form-check-input fs-4 me-3 mt-0" type="checkbox" 
                                       value="{{ $addon['title'] }}" id="addon{{ $index }}" 
                                       style="cursor: pointer; background-color: white; border-color: white;">
                                
                                <label class="form-check-label fs-5 fw-bold" for="addon{{ $index }}" style="cursor: pointer;">
                                    {{ $addon['title'] }}
                                </label>
                            </div>
                            
                            <button type="button" class="btn btn-sm text-white p-0 toggle-desc" data-target="desc{{ $index }}">
                                <i class="fa-solid fa-chevron-down fs-5"></i>
                            </button>
                        </div>

                        <div id="desc{{ $index }}" class="mt-2 text-white-50 small" style="display: none; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 10px; margin-left: 2.8rem;">
                            {{ $addon['desc'] }}
                        </div>

                    </div>
                    @endforeach

                </div>

                <button type="submit" class="btn btn-light w-100 mt-5 py-3 fw-bold rounded-pill shadow" 
                        style="color: {{ $bgColor }}; border: none;">
                    Continuar
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-desc').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const content = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (content.style.display === "none") {
                content.style.display = "block";
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                content.style.display = "none";
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });
    });
</script>
@endsection