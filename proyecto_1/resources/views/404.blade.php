@extends('layout.main')

@section('title', 'No se encontró la página :: DV Películas')

@section('main')
    <h1>No encontramos la página que estás buscando.</h1>
    <a href="{{ route('movies.index') }}">Ir al listado de películas.</a>
@endsection
