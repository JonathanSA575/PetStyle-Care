@extends('layouts.app')

@section('titulo', 'Contáctanos')

@section('content')
<div class="container py-5">
    
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="p-5 rounded-4 shadow-sm" style="background-color: #E8F4F8;">
                <h1 class="fw-bold mb-4">Contáctanos</h1>
                
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg border-0 rounded-pill py-3 px-4" placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-lg border-0 rounded-pill py-3 px-4" placeholder="Correo electrónico">
                    </div>
                    <div class="mb-4">
                        <textarea class="form-control border-0 rounded-4 py-3 px-4" rows="5" placeholder="Mensaje"></textarea>
                    </div>
                    
                    <button type="button" class="btn w-100 text-white fw-bold py-3 rounded-pill shadow-sm" 
                            style="background-color: #FF527B; border: none; font-size: 18px;">
                        Enviar
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-6 text-center">
            <img src="https://img.freepik.com/free-vector/flat-people-with-pets-illustration_23-2148980868.jpg" 
                 class="img-fluid" style="max-width: 80%;">
        </div>
    </div>

</div>
@endsection