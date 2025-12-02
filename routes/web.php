<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controladores
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;

// Grupo de rutas que requieren inicio de sesión
Route::middleware(['auth'])->group(function () {
    Route::get('/mi-perfil', [ProfileController::class, 'index'])->name('profile.index');
    // Aquí pondremos luego mis-pedidos y mis-citas
});
Route::middleware(['auth'])->group(function () {
    Route::get('/mi-perfil', [ProfileController::class, 'index'])->name('profile.index');
    
    // RUTA NUEVA PARA GUARDAR
    Route::put('/mi-perfil', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/quienes-somos', [PageController::class, 'about'])->name('pages.about');
Route::get('/contacto', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/privacidad', [PageController::class, 'privacy'])->name('pages.privacy');


Route::get('/pagar', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/pagar', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/servicio/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/agregar-carrito/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/borrar-carrito', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/actualizar-carrito', [CartController::class, 'update'])->name('cart.update');
// Catálogo general (Página 8 del PDF)
Route::get('/productos', [ProductController::class, 'index'])->name('products.index');

// Detalle de un producto (Página 9 del PDF)
Route::get('/producto/{sku}', [ProductController::class, 'show'])->name('products.show');

// 1️⃣ Rutas de autenticación por defecto (login, register, logout, etc.)
Auth::routes();

// 2️⃣ Ruta raíz → envía al login
Route::get('/', function () {
    return redirect()->route('login');
});

// 3️⃣ RUTA HOME (DESPUÉS DEL LOGIN)
Route::get('/home', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');


// 4️⃣ BUSCADOR DE PRODUCTOS
Route::get('/buscar', [ProductController::class, 'buscar'])
    ->name('productos.buscar');


// 5️⃣ LOGIN CON GOOGLE (AJUSTADO A TU REDIRECT DE GOOGLE)
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])
    ->name('google.login');

Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);


// 6️⃣ PERFIL DEL USUARIO
Route::middleware('auth')->get('/perfil', function () {
    return view('perfil');
})->name('perfil');


// 7️⃣ RUTAS DE ADMIN (CRUD PRODUCTOS)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('productos', ProductController::class);
});
