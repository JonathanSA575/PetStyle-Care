@extends('layouts.app')

@section('titulo', 'Finalizar Compra')

@section('content')
<div class="container py-5">
    
    <h2 class="fw-bold mb-4" style="color: #000;">Compra</h2>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-7">
                
                <div class="card border-0 shadow-sm mb-4 rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3" style="color: #004e64;">Método de pago</h5>
                        <p class="text-muted small">Selecciona el método de pago.</p>
                        
                        <div class="d-flex gap-3 mb-3">
                            <div class="form-check p-3 border rounded w-100 position-relative">
                                <input class="form-check-input ms-1" type="radio" name="payment_method" id="cash" value="cash" checked>
                                <label class="form-check-label w-100 stretched-link fw-bold ms-2" for="cash">
                                    <i class="fa-solid fa-money-bill-wave me-2 text-success"></i> Efectivo
                                </label>
                            </div>
                            
                            <div class="form-check p-3 border rounded w-100 position-relative">
                                <input class="form-check-input ms-1" type="radio" name="payment_method" id="transfer" value="transfer">
                                <label class="form-check-label w-100 stretched-link fw-bold ms-2" for="transfer">
                                    <i class="fa-solid fa-building-columns me-2 text-primary"></i> Transferencia
                                </label>
                            </div>
                        </div>

                        <div class="alert alert-warning small d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation me-2 fs-5"></i>
                            "Por seguridad, el repartidor solo aceptará pagos exactos o transferencia inmediata."
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3" style="color: #004e64;">Dirección de envío</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Nombre</label>
                                <input type="text" class="form-control bg-light border-0 py-2" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Apellido paterno</label>
                                <input type="text" class="form-control bg-light border-0 py-2" name="lastname_1" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Apellido materno</label>
                                <input type="text" class="form-control bg-light border-0 py-2" name="lastname_2">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Código postal</label>
                                <input type="text" class="form-control bg-light border-0 py-2" name="zip" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Estado</label>
                                <input type="text" class="form-control bg-light border-0 py-2" name="state" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Calle</label>
                                <input type="text" class="form-control bg-light border-0 py-2" name="street" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-muted small fw-bold">No. Ext</label>
                                <input type="text" class="form-control bg-light border-0 py-2" name="num_ext" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-muted small fw-bold">No. Int</label>
                                <input type="text" class="form-control bg-light border-0 py-2" name="num_int">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Teléfono de contacto</label>
                                <input type="tel" class="form-control bg-light border-0 py-2" name="phone" required>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-5">
                <div class="card border-0 shadow-sm rounded-4 bg-white position-sticky" style="top: 100px;">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="fw-bold" style="color: #0097B2;">Resumen de tu pedido</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="mb-4" style="max-height: 300px; overflow-y: auto;">
                            @foreach($cart as $item)
                            <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                <div class="position-relative">
                                    <img src="{{ $item['image'] }}" class="rounded" width="60" height="60" style="object-fit: cover;">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                        {{ $item['quantity'] }}
                                    </span>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-0 fw-bold small">{{ $item['name'] }}</h6>
                                    <small class="text-muted">Talla: {{ $item['size'] }}</small>
                                </div>
                                <div class="fw-bold text-dark">${{ $item['price'] * $item['quantity'] }}</div>
                            </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <span class="fw-bold">${{ $total }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Envío:</span>
                            <span class="text-success fw-bold">Gratis</span>
                        </div>
                        
                        <div class="d-flex justify-content-between border-top pt-3 mb-4">
                            <span class="fw-bold fs-5">Total:</span>
                            <span class="fw-bold fs-4 text-dark">MXN ${{ $total }}</span>
                        </div>

                        <button type="submit" class="btn w-100 text-white fw-bold py-3 rounded-pill shadow-sm" 
                                style="background-color: #FF527B; border: none; font-size: 18px;">
                            Confirmar pedido
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection