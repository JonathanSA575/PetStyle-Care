@extends('layouts.app')

@section('titulo', $product->name)

@section('content')
<div class="container py-5">
    
    <a href="{{ route('products.index') }}" class="btn btn-danger text-white rounded-pill px-4 mb-4" style="background-color: #FF527B; border:none;">
        <i class="fa-solid fa-chevron-left"></i> Regresar
    </a>

    <div class="row bg-white rounded shadow-sm p-4">
        <div class="col-md-7 d-flex gap-3">
            <div class="d-flex flex-column gap-2">
                <img src="{{ $product->image }}" class="rounded border" width="60" height="60" style="object-fit: contain;">
                <img src="{{ $product->image }}" class="rounded border" width="60" height="60" style="object-fit: contain;">
                <img src="{{ $product->image }}" class="rounded border" width="60" height="60" style="object-fit: contain;">
            </div>
            
            <div class="flex-grow-1 border rounded d-flex align-items-center justify-content-center p-3">
                <img src="{{ $product->image }}" class="img-fluid" style="max-height: 400px;">
            </div>
        </div>

        <div class="col-md-5 ps-md-5">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <h5 class="text-muted">{{ $product->subtitle }}</h5>
            
            <h1 class="fw-bold my-3 text-dark">${{ number_format($product->price, 2) }}</h1>

            <div class="mb-4">
                <label class="fw-bold mb-2">Cantidad:</label>
                <select class="form-select w-50">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>

            <form action="{{ route('cart.add', $product->sku) }}" method="POST"> @csrf
                <input type="hidden" name="quantity" value="1">
                
                <button type="submit" class="btn btn-lg w-100 text-white mb-3 fw-bold" style="background-color: #FF527B; border-radius: 15px;">
                    Agregar al carrito
                </button>
            </form>
            
            <button class="btn btn-outline-secondary w-100 fw-bold border-0" style="border-radius: 15px;">
                <i class="fa-regular fa-heart"></i> Agregar a lista
            </button>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h4 class="fw-bold border-bottom pb-2">Información del producto</h4>
            <p class="mt-3 text-secondary">
                {{ $product->description }}
            </p>
            
            <h5 class="fw-bold mt-4">Especificaciones</h5>
            <table class="table table-striped mt-2">
                @foreach($product->specs as $key => $val)
                <tr>
                    <td class="fw-bold text-muted">{{ $key }}</td>
                    <td>{{ $val }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection