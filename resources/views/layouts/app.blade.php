<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetStyle & Care - @yield('titulo')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body { margin: 0; padding: 0; font-family: 'Nunito', sans-serif; background-color: #fff; }

        /* HEADER */
        header {
            background: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-bottom: 1px solid #eee;
        }

        .logo-container img { height: 50px; width: auto; }

        /* BUSCADOR */
        .search-container {
            flex-grow: 1;
            margin: 0 30px;
            position: relative;
            max-width: 700px;
        }
        .search-container input {
            width: 100%;
            height: 45px;
            padding: 0 50px 0 20px;
            border: 1px solid #ccc;
            border-radius: 50px;
            font-size: 16px;
            color: #666;
            outline: none;
        }
        .search-btn {
            border: none; 
            background: none; 
            position: absolute; 
            right: 20px; 
            top: 50%; 
            transform: translateY(-50%); 
            cursor: pointer;
            color: #0097B2; 
            font-size: 18px;
        }

        /* ICONOS DE USUARIO */
        .user-nav { display: flex; align-items: center; gap: 25px; }
        .user-nav i { font-size: 24px; cursor: pointer; color: #008CBA; }
        .user-nav a { text-decoration: none; }
    </style>
</head>
<body>

    <header>
        <div class="logo-container">
            <a href="/">
                {{-- Asegúrate de copiar tu logo.png a public/images/ --}}
                <img src="{{ asset('images/logo.png') }}" alt="PetStyle Logo" onerror="this.style.display='none'">
            </a>
        </div>

        {{-- BUSCADOR --}}
        <form action="#" method="GET" class="search-container">
            <input type="text" name="query" placeholder="Buscar productos..." value="{{ request('query') }}">
            <button type="submit" class="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        <div class="user-nav">
            {{-- Si ya inició sesión, mostramos su nombre --}}
            @guest
                <a href="{{ route('login') }}" style="font-weight: bold; color: #0097B2;">Iniciar Sesión</a>
            @else
                <span style="font-weight: bold; color: #555;">{{ Auth::user()->name }}</span>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-sign-out-alt" style="color: #FF527B;" title="Salir"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            @endguest
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>