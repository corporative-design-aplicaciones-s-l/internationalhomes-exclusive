@extends('layouts.guest')

@section('title', ucfirst($slug))

@section('content')
<section class="container py-5">
    <h2 class="text-center mb-4">Información de {{ ucfirst($slug) }}</h2>

    {{-- Aquí iría la información específica de la zona --}}
    <p>Descripción detallada de la zona: {{ ucfirst($slug) }}.</p>
    <div id="map" style="height: 400px;"></div>
</section>
@endsection
