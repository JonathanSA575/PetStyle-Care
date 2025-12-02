<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetStyle & Care - @yield('titulo')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body { margin: 0; padding: 0; font-family: 'Nunito', sans-serif; background-color: #fff; display: flex; flex-direction: column; min-height: 100vh; }
        
        main { flex: 1; }

        /* HEADER */
        header {
            background: white;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo-container img { height: 60px; width: auto; }

        /* BUSCADOR */
        .search-container {
            flex-grow: 1;
            margin: 0 40px;
            position: relative;
            max-width: 600px;
        }
        .search-container input {
            width: 100%;
            height: 40px;
            padding: 0 45px 0 20px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 15px;
            color: #666;
            outline: none;
        }
        .search-btn {
            border: none; background: none; position: absolute; 
            right: 15px; top: 50%; transform: translateY(-50%); 
            cursor: pointer; color: #0097B2; font-size: 16px;
        }

        /* ICONOS HEADER */
        .header-icons { display: flex; align-items: center; gap: 20px; }
        .icon-btn { color: #004e64; font-size: 20px; cursor: pointer; position: relative; }
        
        /* PERFIL DE USUARIO */
        .user-profile { display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .user-avatar {
            width: 40px; height: 40px; border-radius: 50%; object-fit: cover;
            border: 2px solid #eee;
        }

        /* FOOTER (Del PDF) */
        footer { background-color: #004e64; color: white; padding: 40px 30px; margin-top: 50px; }
        .footer-content { display: grid; grid-template-columns: 1fr 1fr 1fr 1.5fr; gap: 20px; max-width: 1200px; margin: 0 auto; }
        .footer-col h4 { color: #0097B2; font-weight: 800; margin-bottom: 15px; font-size: 14px; text-transform: uppercase; }
        .footer-col ul { list-style: none; padding: 0; }
        .footer-col ul li { margin-bottom: 8px; font-size: 13px; color: #eee; cursor: pointer; }
        .contact-row { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-size: 13px; }
        .contact-row i { color: white; font-size: 16px; }

        @media (max-width: 768px) {
            header { flex-direction: column; gap: 10px; }
            .search-container { margin: 10px 0; width: 100%; }
            .footer-content { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo-container">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="PetStyle Logo">
            </a>
        </div>

        <form action="#" method="GET" class="search-container">
            <input type="text" name="query" placeholder="Buscar..." value="{{ request('query') }}">
            <button type="submit" class="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        <div class="header-icons">
    
            <a href="{{ route('cart.index') }}" class="icon-btn" style="text-decoration: none; color: inherit;">
                <i class="fa-solid fa-cart-shopping"></i>
                
                {{-- Opcional: Si quieres mostrar un numerito rojo con la cantidad de productos --}}
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5em;">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>
        
            @guest
                <a href="{{ route('login') }}" style="font-weight: bold; color: #0097B2; text-decoration: none;">Ingresar</a>
                @else
                <div class="dropdown">
                    <a href="#" role="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" class="d-flex align-items-center text-decoration-none">
                        <img 
                            src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=random' }}" 
                            alt="Perfil" 
                            class="user-avatar"
                            style="cursor: pointer;"
                        >
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2" aria-labelledby="userMenu">
                        
                        <li class="px-3 py-2 border-bottom mb-2">
                            <span class="d-block fw-bold text-dark">{{ Auth::user()->name }}</span>
                            <span class="d-block small text-muted" style="font-size: 12px;">{{ Auth::user()->email }}</span>
                        </li>

                        <li>
                            <a class="dropdown-item py-2" href="{{ route('profile.index') }}">
                                <i class="fa-regular fa-user me-2 text-primary"></i> Mi Perfil
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fa-solid fa-box-open me-2 text-warning"></i> Mis Pedidos
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fa-regular fa-calendar-check me-2 text-success"></i> Mis Citas
                            </a>
                        </li>
                        
                        <li><hr class="dropdown-divider"></li>
                        
                        <li>
                            <a class="dropdown-item py-2 text-danger fw-bold" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            @endguest
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-col">
                <img 
  src="{{ asset('images/Logo PetStyle&Care footer.png') }}" 
  alt="Logo White" 
  style="filter: brightness(0) invert(1); width: 80px; height: auto;">

                <div style="margin-top: 5px;">
                    <h4 style="color: white;">SERVICIOS</h4>
                    <ul>
                        <li>Paseo</li>
                        <li>Estética</li>
                        <li>Spa canino</li>
                    </ul>
                </div>
            </div>
            <div class="footer-col">
                <h4>CATEGORÍAS</h4>
                <ul>
                    <li>Alimento</li>
                    <li>Juguetes</li>
                    <li>Ropa</li>
                    <li>Accesorios</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>ENLACES DE INTERÉS</h4>
                <ul>
                    <li><a href="{{ route('pages.privacy') }}" style="color: #eee; text-decoration: none;">Aviso de privacidad</a></li>
                    <li><a href="{{ route('pages.privacy') }}" style="color: #eee; text-decoration: none;">Términos y condiciones</a></li>
                    <li><a href="{{ route('pages.about') }}" style="color: #eee; text-decoration: none;">Sobre Nosotros</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>CONTÁCTANOS</h4>
                <div class="contact-row">
                    <i class="fa-solid fa-phone"></i> 5544555613
                </div>
                <div class="contact-row">
                    <i class="fa-regular fa-envelope"></i> atencionaclientes@petstyle.mx
                </div>
                <div class="contact-row">
                    <i class="fa-solid fa-mobile-screen"></i> 779 142 4658
                </div>
            </div>
        </div>
    </footer>

</body>
</html>