<?php
/** @var \App\Models\Movie[]|\Illuminate\Database\Eloquent\Collection $movies */
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

<div wire:offline.remove>
    @livewire('search-bar')
</div>

@endsection
