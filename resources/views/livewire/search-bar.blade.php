<?php
/** @var \App\Models\Movie[]|\Illuminate\Database\Eloquent\Collection $movies */
/** @var array|null $searchParams */
?>
<section class="mb-2">
    <div wire:offline>
        <div class="alert alert-warning" role="alert">
            Necesitas tener conexión a internet para continuar utilizando la aplicación.
        </div>
    </div>

    <div wire:offline.remove>
       <form action="#" wire:submit.prevent="searchMovies">
           <div class="mb-3">
               <label for="searchTitle" class="form-label">Título</label>
               <input type="text"
                      class="form-control"
                      id="searchTitle"
                      placeholder="Busca por título. Ej: El señor de los anillos..."
                      wire:model.live.blur="searchParams">
           </div>
       </form>
   </div>

    <div wire:offline.remove>
        <div class="table-responsive">
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
    </div>
</section>

