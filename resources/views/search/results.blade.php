@extends('layouts.guest')

@section('title', __('propertySearch.title'))

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">{{ __('propertySearch.heading') }}</h2>

        <div class="row">
            @forelse($results as $property)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset("storage/{$property->thumbnail}") }}" alt="{{ $property->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="card-text">€{{ number_format($property->price, 0, ',', '.') }} ·
                                {{ $property->bedrooms }} {{ __('propertySearch.bedrooms') }} ·
                                {{ $property->bathrooms }} {{ __('propertySearch.bathrooms') }}
                            </p>
                            <a href="{{ route('guest.property.show', ['locale' => app()->getLocale(), 'slug' => $property->slug]) }}"
                                class="btn btn-outline-dark btn-sm">{{ __('propertySearch.more') }}</a>

                        </div>
                    </div>
                </div>
                @empty
                <p>{{ __('propertySearch.no_results') }}</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $results->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
