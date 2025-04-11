@extends('layouts.admin')

@section('title', 'Listado de Propiedades')

@section('styles')
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            font-weight: 600;
        }

        .property-index-wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: calc(100vh - 100px);
        }

        .property-table-scrollable {
            flex-grow: 1;
            overflow-y: auto;
            width: 100%;
        }

        .property-table-scrollable table {
            width: 100% !important;
            table-layout: fixed;
        }

        .property-table-scrollable td {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .property-table-scrollable thead th {
            position: sticky;
            top: 0;
            z-index: 2;
            background-color: #1d1d1f;
            color: white;
        }

        .property-table-scrollable thead th::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1px;
            height: 4px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), transparent);
        }
    </style>
@endsection

@section('content')
    <div class="property-index-wrapper d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Propiedades</h1>
            <a href="{{ route('admin.properties.create') }}" class="btn btn-main">+ Nueva Propiedad</a>
        </div>

        <div class="search-bar mb-3">
            <form id="property-search-form" method="GET" class="d-flex flex-wrap align-items-center gap-2">
                <input type="text" name="search" id="search-input" class="form-control"
                    placeholder="Buscar por título, ubicación o referencia..." style="max-width: 100%;">
            </form>
        </div>

        <div id="property-table" class="property-table-scrollable">
            @include('admin.properties._table', ['properties' => $properties])
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $properties->links('pagination::bootstrap-5') }}
    </div>
@endsection

@section('scripts')
    document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById('search-input');
    const tableWrapper = document.getElementById('property-table');

    let typingTimer;
    const delay = 400;

    input.addEventListener('input', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => {
    const query = input.value;
    fetch(`?search=${encodeURIComponent(query)}`, {
    headers: {
    'X-Requested-With': 'XMLHttpRequest'
    }
    })
    .then(response => response.text())
    .then(html => {
    tableWrapper.innerHTML = html;
    });
    }, delay);
    });


@endsection
