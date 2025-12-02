@extends('layouts.app')

@section('titulo', 'Quiénes Somos')

@section('content')
<div class="container py-5 text-center" style="max-width: 800px;">
    
    <h1 class="fw-bold mb-4" style="color: #004e64;">Quiénes somos</h1>
    
    <div class="mb-5">
        <p class="fs-5 text-muted">
            Programming is the process of creating instructions that a computer follows to perform specific tasks.
            By writing code, programmers build applications, automate processes, and develop software that powers everything from websites to smartphones.
        </p>
    </div>

    <img src="https://images.unsplash.com/photo-1612536053381-696179b53683?auto=format&fit=crop&w=400&q=80" 
         class="rounded-circle mb-5 shadow" 
         style="width: 250px; height: 250px; object-fit: cover; border: 5px solid #fff;">

    <h2 class="fw-bold mb-3" style="color: #0097B2;">Visión</h2>
    <p class="text-muted mb-5">
        Programming is the process of creating instructions that a computer follows to perform specific tasks.
        By writing code, programmers build applications, automate processes, and develop software.
    </p>

    <h2 class="fw-bold mb-3" style="color: #FF527B;">Misión</h2>
    <p class="text-muted">
        Programming is the process of creating instructions that a computer follows to perform specific tasks.
        By writing code, programmers build applications, automate processes, and develop software that powers everything.
    </p>

</div>
@endsection