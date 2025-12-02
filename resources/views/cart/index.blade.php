@extends('layouts.app')

@section('titulo', 'Tu Carrito')

@section('content')

{{-- Agregamos jQuery para que la magia funcione --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="container py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Tu carrito de compras <span class="text-muted fs-5">({{ count(session('cart', [])) }} artículo)</span></h2>
        <a href="{{ route('products.index') }}" class="text-decoration-none fw-bold" style="color: #0097B2;">Continuar comprando</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <h5 class="text-info fw-bold mb-3" style="color: #0097B2 !important;">Productos en tu carrito</h5>
            
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                
                {{-- Fila del producto con ID para identificarlo --}}
                <div class="card mb-3 border border-info bg-light position-relative shadow-sm product_data" 
                     data-id="{{ $id }}"
                     style="border-radius: 15px; border-color: #bee5eb !important;">
                    
                    <div class="card-body">
                        <form action="{{ route('cart.remove') }}" method="POST" class="position-absolute top-0 end-0 p-3">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn btn-sm text-info fw-bold"><i class="fa-solid fa-xmark fs-5"></i></button>
                        </form>

                        <div class="d-flex align-items-center">
                            <img src="{{ $details['image'] }}" class="rounded" style="width: 100px; height: 100px; object-fit: cover; margin-right: 20px;">
                            
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-1">{{ $details['name'] }}</h5>
                                <p class="mb-0 text-muted small">Color: {{ $details['color'] }}</p>
                                <p class="mb-2 text-muted small">Talla: {{ $details['size'] }}</p>
                                
                                <div class="badge bg-danger">20% de Descuento</div> 
                                <h4 class="fw-bold mt-2">${{ $details['price'] }}</h4>
                            </div>

                            <div class="d-flex align-items-center bg-white rounded-pill px-2 border">
                                {{-- Botón Menos --}}
                                <button class="btn btn-sm text-danger fw-bold decrement-btn">-</button>
                                
                                {{-- Input de Cantidad (Lo hacemos readonly para que solo usen botones) --}}
                                <input type="text" value="{{ $details['quantity'] }}" 
                                       class="form-control qty-input border-0 text-center fw-bold p-0" 
                                       style="width: 30px; height: 30px; background: transparent;" readonly>
                                
                                {{-- Botón Más --}}
                                <button class="btn btn-sm text-danger fw-bold increment-btn">+</button>
                            </div>
                        </div>
                        
                        <div class="mt-2 fw-bold small text-muted">SKU: {{ $details['sku'] }}</div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="alert alert-light text-center py-5">
                    <h4>Tu carrito está vacío 🐶</h4>
                    <p class="text-muted">¡Corre a buscarle algo bonito a tu mascota!</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Ir a comprar</a>
                </div>
            @endif

        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="background-color: #E8F4F8; border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-info mb-4" style="color: #0097B2 !important;">Resumen de tu pedido</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span class="fw-bold">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Descuentos:</span>
                        <span class="text-danger">-$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
                        <span>Entrega:</span>
                        <span class="text-success">Gratis</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total:</span>
                        <span class="fw-bold fs-5">${{ number_format($total, 2) }}</span>
                    </div>
                    
                    <p class="text-muted small text-center">Los precios incluyen IVA</p>

                    <a href="{{ route('checkout.index') }}" class="btn w-100 py-2 mb-2 text-white fw-bold shadow-sm" style="background-color: #FF527B; border-radius: 12px;">
                        Comprar ahora
                    </a>
                    
                    <a href="{{ route('products.index') }}" class="btn w-100 py-2 text-white fw-bold shadow-sm" style="background-color: #0097B2; border-radius: 12px;">
                        Continuar buscando
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT PARA ACTUALIZAR CANTIDADES SIN RECARGAR --}}
<script type="text/javascript">
    $(document).ready(function () {

        // AL HACER CLIC EN EL BOTÓN "+"
        $('.increment-btn').click(function (e) {
            e.preventDefault();
            var inc_value = $(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value < 10) { // Límite de 10 productos por seguridad
                value++;
                $(this).closest('.product_data').find('.qty-input').val(value);
                // Llamamos a la función de actualizar
                updateCart($(this));
            }
        });

        // AL HACER CLIC EN EL BOTÓN "-"
        $('.decrement-btn').click(function (e) {
            e.preventDefault();
            var dec_value = $(this).closest('.product_data').find('.qty-input').val();
            var value = parseInt(dec_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) { // No dejar bajar de 1
                value--;
                $(this).closest('.product_data').find('.qty-input').val(value);
                // Llamamos a la función de actualizar
                updateCart($(this));
            }
        });

        // FUNCIÓN QUE HABLA CON EL SERVIDOR
        function updateCart(element) {
            var ele = element.closest('.product_data');
            
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.attr("data-id"), 
                    quantity: ele.find('.qty-input').val()
                },
                success: function (response) {
                    window.location.reload(); // Recargamos para ver el precio nuevo
                }
            });
        }

    });
</script>
@endsection