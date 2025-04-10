@extends('layouts.guest')

@section('title', 'Contáctanos')

@section('style')
<link href="{{ asset(path: 'css/contact.css') }}" rel="stylesheet">

@endsection

@section('content')
<section class="hero-image" style="background: url('/images/contact-hero.jpg') no-repeat center center; background-size: cover; height: 60vh;">
    <div class="container d-flex align-items-center h-100">
        <h1 class="text-white fw-light">Contáctanos</h1>
    </div>
</section>

<section class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Información de contacto</h2>
            <div class="d-flex flex-column mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-telephone me-3" style="font-size: 1.5rem;"></i>
                    <p class="mb-0">Tel: </p>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-envelope me-3" style="font-size: 1.5rem;"></i>
                    <p class="mb-0">Email: </p>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-geo-alt me-3" style="font-size: 1.5rem;"></i>
                    <p class="mb-0">---Dirección---</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h2>Envíanos tu mensaje</h2>
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Escribe tu nombre" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Escribe tu correo electrónico" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Mensaje *</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Escribe tu mensaje" required></textarea>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="accept_terms" name="accept_terms" required>
                    <label class="form-check-label" for="accept_terms">Acepto los términos y condiciones</label>
                </div>

                <button type="submit" class="btn btn-main w-100">Enviar mensaje</button>
            </form>
        </div>
    </div>
</section>
@endsection
