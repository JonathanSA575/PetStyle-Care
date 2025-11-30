<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // 1. Redirigir a Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Recibir respuesta de Google (SIN TRY-CATCH PARA VER EL ERROR)
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Buscamos el usuario
        $user = User::where('email', $googleUser->email)->first();

        if(!$user){
            // Si no existe, lo creamos
            // OJO: Aquí usamos los nombres de la tabla 'users' estándar de Laravel
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => bcrypt('123456dummy'), // Contraseña falsa
                'role' => 'cliente',
                'phone' => null,
            ]);
        } else {
            // Si ya existe, actualizamos los datos de Google
            $user->update([
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
            ]);
        }

        // Iniciamos sesión y vámonos
        Auth::login($user);
        return redirect('/home');
    }
}