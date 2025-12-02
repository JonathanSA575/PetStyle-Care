@extends('layouts.app')

@section('titulo', 'Inicio')

@section('content')

<style>
    /* Estilos Generales */
    .container-home { max-width: 1100px; margin: 0 auto; padding: 20px; }
    h3.section-title { font-weight: 800; font-size: 18px; margin-bottom: 20px; color: #000; }

    /* --- SLIDER PRINCIPAL --- */
    .slider-section { 
        margin-bottom: 40px; 
        position: relative; 
        border-radius: 15px; 
        overflow: hidden; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        aspect-ratio: 16/9; 
        background: #f0f0f0; 
    }
    .slide { display: none; width: 100%; height: 100%; }
    .slide.active { display: block; animation: fadeEffect 0.5s; }
    .slide img, .slide video { width: 100%; height: 100%; object-fit: cover; }
    @keyframes fadeEffect { from {opacity: .4} to {opacity: 1} }
    .slider-nav { position: absolute; top: 50%; width: 100%; display: flex; justify-content: space-between; pointer-events: none; transform: translateY(-50%); z-index: 10; }
    .slider-arrow { pointer-events: all; color: white; font-size: 30px; cursor: pointer; padding: 0 20px; text-shadow: 0 2px 4px rgba(0,0,0,0.5); transition: 0.3s; }
    .slider-arrow:hover { color: #FF527B; transform: scale(1.2); }
    .dots-container { position: absolute; bottom: 15px; width: 100%; text-align: center; z-index: 10; }
    .dot { height: 12px; width: 12px; background-color: rgba(255,255,255,0.5); border-radius: 50%; display: inline-block; margin: 0 5px; cursor: pointer; transition: 0.3s; }
    .dot.active { background-color: #004e64; transform: scale(1.2); }

    /* --- CATEGORIAS Y TEMPORADA --- */
    .banner-img { width: 100%; height: auto; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); display: block; }
    .see-more { text-align: right; color: #0097B2; font-weight: bold; cursor: pointer; margin-top: 10px; font-size: 14px; }
    
    /* Wrapper con scroll horizontal opcional, pero flex-wrap para que bajen si no caben */
    .categories-wrapper { 
        display: flex; 
        align-items: flex-start; /* Alineación superior */
        justify-content: flex-start; /* Pegados a la izquierda o space-around según prefieras */
        gap: 15px; /* Espacio entre items */
        margin-bottom: 40px; 
        overflow-x: auto; 
        padding-bottom: 15px; /* Espacio para scrollbar si aparece */
        flex-wrap: wrap; /* Permitir que bajen si se despliegan muchos */
    }
    
    /* Para centrar cuando son pocos (como en productos) */
    .products-wrapper { justify-content: space-between; }
    /* Para temporada, centramos o usamos space-around */
    .season-wrapper { justify-content: space-around; transition: all 0.3s ease; }

    .cat-item { text-align: center; cursor: pointer; transition: transform 0.2s; color: #333; text-decoration: none; width: 100px; }
    .cat-item:hover { transform: scale(1.05); color: #0097B2; }
    .circle-img {
        width: 90px; height: 90px; background-color: #f5f5f5; border-radius: 50%; 
        display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 2px solid transparent; overflow: hidden;
    }
    .circle-img:hover { border-color: #9D7AD2; }
    .circle-img img { width: 65%; height: auto; object-fit: contain; }

    /* SERVICIOS */
    .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
    .service-card { border-radius: 20px; overflow: hidden; position: relative; height: 250px; cursor: pointer; display: block; text-decoration: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    .service-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
    .service-card:hover img { transform: scale(1.05); }
    .service-title { position: absolute; bottom: 0; width: 100%; background: rgba(255,255,255,0.95); text-align: center; padding: 12px 0; font-weight: 800; color: #004e64; }

    /* CLASE PARA OCULTAR ITEMS */
    .season-hidden { display: none; }
    /* Animación de entrada */
    .fade-in { animation: fadeIn 0.5s; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="container-home">

    <div class="slider-section">
        <div class="slider-nav">
            <div class="slider-arrow" onclick="changeSlide(-1)"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="slider-arrow" onclick="changeSlide(1)"><i class="fa-solid fa-chevron-right"></i></div>
        </div>
        
        <div class="slide active">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('images/slider-1.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="slide"><img src="{{ asset('images/slider-2.png') }}" alt="Promo 2"></div>
        <div class="slide"><img src="{{ asset('images/slider-3.png') }}" alt="Promo 3"></div>
        <div class="slide"><img src="{{ asset('images/slider-4.png') }}" alt="Promo 4"></div>
        <div class="slide"><img src="{{ asset('images/slider-5.png') }}" alt="Promo 5"></div>

        <div class="dots-container">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
        </div>
    </div>

    <h3 class="section-title">Descubre lo nuevo...</h3>
    <div class="slider-section" style="aspect-ratio: auto;">
        <img src="{{ asset('images/lo-nuevo.png') }}" alt="Lo nuevo" class="banner-img">
        <a href="{{ route('products.index') }}" class="see-more d-block text-decoration-none">Ver mas <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <h3 class="section-title">Productos</h3>
    <div class="categories-wrapper products-wrapper">
        <div class="slider-arrow text-dark" style="font-size: 20px;"><i class="fa-solid fa-chevron-left"></i></div>
        <a href="{{ route('products.index') }}" class="cat-item">
            <div class="circle-img" style="border: 2px solid #9D7AD2;"><img src="{{ asset('images/alimento.png') }}" alt="Alimento"></div>
            <div class="cat-name">Alimento</div>
        </a>
        <a href="{{ route('products.index') }}" class="cat-item">
            <div class="circle-img"><img src="{{ asset('images/juguetes.png') }}" alt="Juguetes"></div>
            <div class="cat-name">Juguetes</div>
        </a>
        <a href="{{ route('products.index') }}" class="cat-item">
            <div class="circle-img"><img src="{{ asset('images/ropa.png') }}" alt="Ropa"></div>
            <div class="cat-name">Ropa</div>
        </a>
        <a href="{{ route('products.index') }}" class="cat-item">
            <div class="circle-img"><img src="{{ asset('images/accesorios.png') }}" alt="Accesorios"></div>
            <div class="cat-name">Accesorios</div>
        </a>
        <div class="slider-arrow text-dark" style="font-size: 20px;"><i class="fa-solid fa-chevron-right"></i></div>
    </div>

    <h3 class="section-title">Temporada</h3>
    <div class="categories-wrapper season-wrapper" id="seasonContainer">
        
        <div class="cat-item">
            <div class="circle-img"><img src="{{ asset('images/primavera.png') }}" alt="Primavera"></div>
            <div class="cat-name">Primavera</div>
        </div>
        <div class="cat-item">
            <div class="circle-img"><img src="{{ asset('images/verano.png') }}" alt="Verano"></div>
            <div class="cat-name">Verano</div>
        </div>
        <div class="cat-item">
            <div class="circle-img"><img src="{{ asset('images/otoño.png') }}" alt="Otoño"></div>
            <div class="cat-name">Otoño</div>
        </div>
        <div class="cat-item">
            <div class="circle-img"><img src="{{ asset('images/halloween.png') }}" alt="Halloween"></div>
            <div class="cat-name">Halloween</div>
        </div>

        <div class="cat-item season-hidden fade-in">
            <div class="circle-img"><img src="{{ asset('images/invierno.png') }}" alt="Invierno"></div>
            <div class="cat-name">Invierno</div>
        </div>
        <div class="cat-item season-hidden fade-in">
            <div class="circle-img"><img src="{{ asset('images/navidad.png') }}" alt="Navidad"></div>
            <div class="cat-name">Navidad</div>
        </div>

        <div class="cat-item" onclick="toggleSeasons()">
            <div class="circle-img" style="background-color: #004e64;">
                <i id="seasonArrow" class="fa-solid fa-chevron-down" style="color: white; font-size: 30px;"></i>
            </div>
        </div>

    </div>

    <hr style="border: 0; border-top: 1px solid #eee; margin: 40px 0;">

    <h3 class="section-title">Servicios para tu mascota</h3>
    <div class="services-grid">
        <a href="{{ route('services.show', 'paseo') }}" class="service-card">
            <img src="{{ asset('images/servicios-paseo.jpg') }}" alt="Paseo">
            <div class="service-title">Paseo</div>
        </a>
        <a href="{{ route('services.show', 'estetica') }}" class="service-card">
            <img src="{{ asset('images/servicios-estetica.jpg') }}" onerror="this.src='{{ asset('images/servicios-estetica.png') }}'" alt="Estética">
            <div class="service-title">Estética</div>
        </a>
        <a href="{{ route('services.show', 'spa') }}" class="service-card">
            <img src="{{ asset('images/servicios-spa.jpg') }}" alt="Spa canino">
            <div class="service-title">Spa canino</div>
        </a>
    </div>

</div>

{{-- SCRIPTS --}}
<script>
    // --- LÓGICA DEL SLIDER ---
    let slideIndex = 1;
    showSlides(slideIndex);
    function changeSlide(n) { showSlides(slideIndex += n); }
    function currentSlide(n) { showSlides(slideIndex = n); }
    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("slide");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].classList.remove("active");
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].classList.remove("active");
        }
        slides[slideIndex-1].style.display = "block";
        slides[slideIndex-1].classList.add("active");
        dots[slideIndex-1].classList.add("active");
    }
    setInterval(function() { changeSlide(1); }, 5000);

    // --- LÓGICA DE TEMPORADA (TOGGLE) ---
    function toggleSeasons() {
        // Seleccionamos todos los items ocultos
        const hiddenItems = document.querySelectorAll('.season-hidden');
        const arrow = document.getElementById('seasonArrow');

        hiddenItems.forEach(item => {
            // Si están ocultos (display: none por clase CSS)
            if (getComputedStyle(item).display === 'none') {
                item.style.display = 'block'; // Mostramos
                arrow.classList.remove('fa-chevron-down');
                arrow.classList.add('fa-chevron-up'); // Flecha arriba
            } else {
                item.style.display = 'none'; // Ocultamos
                arrow.classList.remove('fa-chevron-up');
                arrow.classList.add('fa-chevron-down'); // Flecha abajo
            }
        });
    }
</script>

@endsection