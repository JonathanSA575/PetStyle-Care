@extends('layouts.app')

@section('titulo', 'Mi Perfil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            
            {{-- Mensaje de Éxito --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                
                <div class="card-header border-0 py-5 text-center position-relative" style="background: linear-gradient(135deg, #004e64, #0097B2);">
                    <div class="position-absolute start-50 translate-middle" style="top: 100%;">
                        <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random' }}" 
                             alt="Perfil" 
                             class="rounded-circle border border-4 border-white shadow" 
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                </div>

                <div class="card-body pt-5 mt-4 px-5 pb-5">
                    
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark">{{ $user->name }}</h2>
                        <span class="badge bg-light text-dark border fs-6 px-3 py-2">
                            @if($user->google_id)
                                <i class="fa-brands fa-google me-2 text-danger"></i> Cuenta vinculada con Google
                            @else
                                <i class="fa-regular fa-envelope me-2 text-primary"></i> Cuenta con Correo
                            @endif
                        </span>
                    </div>

                    {{-- INICIO DEL FORMULARIO --}}
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT') <div class="row g-4">
                            <div class="col-12">
                                <h5 class="fw-bold" style="color: #004e64;"><i class="fa-regular fa-id-card me-2"></i> Información Personal</h5>
                                <hr>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Correo Electrónico</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->email }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Fecha de Registro</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->created_at->format('d/m/Y') }}" readonly>
                            </div>

                            <div class="col-12 mt-5">
                                <h5 class="fw-bold" style="color: #004e64;"><i class="fa-solid fa-map-location-dot me-2"></i> Datos de Envío</h5>
                                <p class="text-muted small">Esta información se usará para tus próximas compras.</p>
                                <hr>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Teléfono</label>
                                <input type="text" name="phone" class="form-control" 
                                       placeholder="Agrega tu teléfono..." 
                                       value="{{ old('phone', $user->phone) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Ciudad/Estado</label>
                                <input type="text" name="city" class="form-control" 
                                       placeholder="Ej: CDMX" 
                                       value="{{ old('city', $user->city) }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Dirección Completa</label>
                                <textarea name="address" class="form-control" rows="2" 
                                          placeholder="Calle, Número, Colonia, Código Postal...">{{ old('address', $user->address) }}</textarea>
                            </div>
                            
                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn text-white fw-bold px-5 py-2 rounded-pill shadow-sm" style="background-color: #FF527B; transition: transform 0.2s;">
                                    Guardar Cambios
                                </button>
                            </div>

                        </div>
                    </form>
                    {{-- FIN DEL FORMULARIO --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection