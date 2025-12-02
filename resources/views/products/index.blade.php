@extends('layouts.app')

@section('titulo', 'Productos')

@section('content')
<div class="container py-4">
    
    <div class="card border-0 shadow-sm mb-4 bg-light rounded-3">
        <div class="card-body p-3">
            <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                
                <div class="row g-3 align-items-center">
                    
                    <div class="col-auto">
                        <label class="visually-hidden">Ordenar</label>
                        <select name="sort" class="form-select border-0 bg-transparent fw-bold" onchange="this.form.submit()" style="cursor: pointer;">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Novedades</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Precio: Bajo a Alto</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio: Alto a Bajo</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <label class="visually-hidden">Categoría</label>
                        <select name="category" class="form-select border-0 bg-transparent fw-bold" onchange="this.form.submit()" style="cursor: pointer;">
                            <option value="">Todas las Categorías</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto">
                        <label class="visually-hidden">Marca</label>
                        <select name="brand" class="form-select border-0 bg-transparent fw-bold" onchange="this.form.submit()" style="cursor: pointer;">
                            <option value="">Todas las Marcas</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col text-end">
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-danger rounded-pill px-3" style="border: 1px solid #FF527B; color: #FF527B;">
                            <i class="fa-solid fa-filter-circle-xmark"></i> Limpiar
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($products as $product)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; transition: transform 0.2s;">
                
                <div class="position-absolute end-0 top-0 p-3 text-muted" style="cursor: pointer; z-index: 10;">
                    <i class="fa-regular fa-heart text-danger"></i>
                </div>
                
                <div class="p-4 d-flex align-items-center justify-content-center" style="height: 250px; background-color: #fff;">
                    <img src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : asset('images/' . $product->image_path) }}" 
                         class="img-fluid" 
                         alt="{{ $product->name }}" 
                         style="max-height: 100%; object-fit: contain;">
                </div>
                
                <div class="card-body text-center bg-light">
                    <p class="text-uppercase text-muted fw-bold small mb-1">{{ $product->brand }}</p>
                    <h5 class="card-title fw-bold text-dark text-truncate">{{ $product->name }}</h5>
                    
                    <div class="mb-2 text-warning small">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <h4 class="fw-bold text-dark" style="color: #004e64 !important;">${{ number_format($product->price, 2) }}</h4>
                    
                    <a href="{{ route('products.show', $product->sku) }}" class="btn btn-outline-primary rounded-pill w-100 mt-2 fw-bold" style="border-color: #0097B2; color: #0097B2;">
                        Ver Detalle
                    </a>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5">
                <h3 class="text-muted">No encontramos productos con ese filtro 🐶</h3>
                <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Ver todos</a>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>

<style>
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
    .btn-outline-primary:hover { background-color: #0097B2 !important; color: white !important; }
</style>
@endsection