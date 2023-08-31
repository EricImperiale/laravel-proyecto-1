<?php
/** @var \App\Models\Movie[]|\Illuminate\Database\Eloquent\Collection $movies */
/** @var \App\Searches\MovieSearchParams $searchParams */
/** @var array|null $searchParams */
?>
@extends('layout.main')

@section('title', 'Listado de Películas')

@section('main')
<h1 class="mb-3">Películas</h1>

@auth
<div class="mb-4">
    <div><a href="{{ route('movies.formNew') }}">Publicar una Nueva Película</a></div>
    <div><a href="{{ route('movies.trashed.index') }}">Ver Películas Eliminadas</a></div>
</div>
@endauth

<section class="mb-4">
    <h2 class="mb-2">Buscador</h2>

    <form action="{{ route('movies.index') }}" method="get">
        <div class="mb-3">
            <label for="searchTitle" class="form-label">Título</label>
            <input
                type="search"
                id="searchTitle"
                name="t"
                class="form-control"
                value="{{ $searchParams ?? null }}"
            >
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</section>

<h2 class="visually-hidden">Lista de Productos</h2>

@if($searchParams && $movies->isNotEmpty())
    <p class="mb-3">Se muestran los resultados para la búsqueda del título <b>{{ $searchParams }}</b>.</p>
@endif

<div class="row">
    @if($movies->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha de Estreno</th>
                    <th>Precio</th>
                    <th>Clasificación</th>
                    <th>País de Origen</th>
                    <th>Géneros</th>
                    <th>Sinopsis</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($movies as $movie)
                    <tr>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->release_date }}</td>
                        <td>${{ $movie->price }}</td>
                        <td>{{ $movie->classification->abbreviation }}</td>
                        <td>{{ $movie->country->alpha3 }}</td>
                        <td>
                            @forelse($movie->genres as $genre)
                                <span class="badge bg-secondary">{{ $genre->name }}</span>
                            @empty
                                Sin géneros.
                            @endforelse
                        </td>
                        <td>{{ $movie->synopsis }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('movies.view', ['id' => $movie->movie_id]) }}" class="btn btn-secondary">Ver</a>
                                @auth
                                    <a href="{{ route('movies.formUpdate', ['id' => $movie->movie_id]) }}" class="btn btn-primary">Editar</a>
                                    <a href="{{ route('movies.confirmDelete', ['id' => $movie->movie_id]) }}" class="btn btn-danger">Eliminar</a>
                                @endauth
                            </div>
                        </td>
                    </tr>
                @empty
                    <p>No hay películas para mostrar.</p>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $movies->links() }}
    @else
        <p>No hay películas para mostrar con el título <b>{{ $searchParams }}</b>.</p>
    @endif
</div>
@endsection
<!-- <form action="" method="post">

<button type="submit" class="btn btn-secondary">Reservar</button>
</form> -->
