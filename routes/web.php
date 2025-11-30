<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- IMPORTACIONES OBLIGATORIAS (Esto es lo que faltaba) ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
// ----------------------------------------------------------

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Activar rutas de autenticación (Login, Registro, Logout)
Auth::routes();

// 1. Ruta de Inicio: Si entran, los mandamos al Login directo
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Ruta "Home": Esta es la que verán DESPUÉS de iniciar sesión (La Tienda)
Route::get('/home', function () {
    return view('welcome');
})->name('home')->middleware('auth');

// 3. Ruta del Buscador de Productos
Route::get('/buscar', [ProductController::class, 'buscar'])->name('productos.buscar');

// 4. Rutas de Google
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

// 5. Ruta del Perfil / Dashboard (Cuando entras)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 6. Ruta de Mi Perfil (Vista personalizada)
Route::middleware('auth')->get('/perfil', function () {
    return view('perfil'); // Asegúrate de tener perfil.blade.php en resources/views
})->name('perfil');

// 7. Rutas de Admin (Productos)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Aquí Laravel crea automáticamente todas las rutas del CRUD (index, create, store, etc.)
    Route::resource('productos', ProductController::class);
});