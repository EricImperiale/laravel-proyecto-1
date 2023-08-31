<?php
/** @var \App\Models\Country[]|\Illuminate\Database\Eloquent\Collection $countries */
/** @var \App\Models\Genre[]|\Illuminate\Database\Eloquent\Collection $genres */
/** @var \App\Models\Classification[]|\Illuminate\Database\Eloquent\Collection $classifications */
/** @var \Illuminate\Support\ViewErrorBag $errors */
?>
@extends('layout.main')

@section('title', 'Publicar una Nueva Película')

@section('main')
    <h1>Publicar una Nueva Película</h1>

    <form action="{{ route('movies.processNew') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                @if($errors->has('title')) aria-describedby="error-title" @endif
                value="{{ old('title') }}"
            >
            @error('title')
                <div class="mt-2 text-danger" id="error-title">{{ $message }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Fecha de Estreno</label>
            <input
                type="date"
                id="release_date"
                name="release_date"
                class="form-control"
                @error('release_date') aria-describedby="error-release_date" @enderror
                value="{{ old('release_date') }}"
            >
            @error('release_date')
                <div class="mt-2 text-danger" id="error-release_date">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input
                type="text"
                id="price"
                name="price"
                class="form-control"
                @error('price') aria-describedby="error-price" @enderror
                value="{{ old('price') }}"
            >
            @error('price')
                <div class="mt-2 text-danger" id="error-price">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="country_id" class="form-label">País de Origen</label>
            <select
                name="country_id"
                id="country_id"
                class="form-control"
                @error('country_id') aria-describedby="error-country_id" @enderror
            >
                <option value=""></option>
                @foreach($countries as $country)
                    <option
                        value="{{ $country->country_id }}"
                        @selected(old('country_id') == $country->country_id)
                    >{{ $country->name }}</option>
                @endforeach
            </select>
            @error('country_id')
                <div class="mt-2 text-danger" id="error-country_id">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="classification_id" class="form-label">Clasificación</label>
            <select
                name="classification_id"
                id="classification_id"
                class="form-control"
                @error('classification_id') aria-describedby="error-classification_id" @enderror
            >
                <option value=""></option>
                @foreach($classifications as $classification)
                    <option
                        value="{{ $classification->classification_id }}"
                        @selected(old('classification_id') == $classification->classification_id)
                    >{{ $classification->name }}</option>
                @endforeach
            </select>
            @error('classification_id')
                <div class="mt-2 text-danger" id="error-classification_id">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="synopsis" class="form-label">Sinopsis</label>
            <textarea
                id="synopsis"
                name="synopsis"
                class="form-control"
                @error('synopsis') aria-describedby="error-synopsis" @enderror
            >{{ old('synopsis') }}</textarea>
            @error('synopsis')
                <div class="mt-2 text-danger" id="error-synopsis">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Portada</label>
            <input
                type="file"
                id="cover"
                name="cover"
                class="form-control"
                @error('cover') aria-describedby="error-cover" @enderror
            >
            @error('cover')
                <div class="mt-2 text-danger" id="error-cover">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover_description" class="form-label">Descripción de la Portada</label>
            <input
                type="text"
                id="cover_description"
                name="cover_description"
                class="form-control"
                @error('cover_description') aria-describedby="error-cover_description" @enderror
                value="{{ old('cover_description') }}"
            >
            @error('cover_description')
                <div class="mt-2 text-danger" id="error-cover_description">{{ $message }}</div>
            @enderror
        </div>

        <fieldset>
            <legend>Géneros</legend>

            <div class="mb-3">
            @foreach($genres as $genre)
                <div class="form-check form-check-inline">
                    <label>
                        <input
                            type="checkbox"
                            name="genre_id[]"
                            value="{{ $genre->genre_id }}"
                            class="form-check-input"
                            @checked(in_array($genre->genre_id, old('genre_id', [])))
                        >
                        {{ $genre->name }}
                    </label>
                </div>
            @endforeach
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary">Publicar</button>
    </form>
@endsection
