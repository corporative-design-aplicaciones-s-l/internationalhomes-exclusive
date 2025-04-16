@extends('layouts.guest')

@section('title', 'Viviendas favoritas')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 fw-light text-center">Tus propiedades favoritas</h1>

        @if ($favorites->isEmpty())
            <p class="text-center">Aún no has guardado ninguna propiedad como favorita.</p>
        @else
            <div class="row gx-4 gy-4">
                @foreach ($favorites as $property)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <a href="{{ route('guest.property.show', $property->slug) }}">
                                <img src="{{ asset('storage/' . $property->thumbnail) }}" class="card-img-top"
                                    alt="{{ $property->title }}">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $property->title }}</h5>
                                <p class="card-text text-muted small">
                                    {{ $property->location }} – €{{ number_format($property->price, 0, ',', '.') }}
                                </p>
                                <a href="{{ route('guest.property.show', $property->slug) }}" class="btn btn-outline-dark btn-sm">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
