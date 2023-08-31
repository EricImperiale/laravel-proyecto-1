<?php
/** @var \App\Models\Movie $movie */
/** @var string $route */
?>
<article class="mb-3">
    <div class="row flex-row-reverse mb-3">
        <div class="col-9">
            <h1 class="mb-3">{{ $movie->title }}</h1>

            <dl>
                <dt>Precio</dt>
                <dd>$ {{ $movie->price }}</dd>
                <dt>Fecha de Estreno</dt>
                <dd>{{ $movie->release_date }}</dd>
                <dt>Clasificación</dt>
                <dd>{{ $movie->classification->name }} ({{ $movie->classification->abbreviation }})</dd>
                <dt>País de Origen</dt>
                <dd>{{ $movie->country->name }} ({{ $movie->country->alpha3 }})</dd>
                <dt>Géneros</dt>
                <dd>
                    @foreach($movie->genres as $genre)
                        <span class="badge bg-secondary">{{ $genre->name }}</span>
                    @endforeach
                </dd>
                @if($route !== 'eliminar')
                    @auth
                        <dt>Reservar</dt>
                        <dd>
                            <div id="mercadopago"></div>
                        </dd>
                    @else
                        <dt>Reservar</dt>
                        <dd>Para reservar una película tenés que estar registrado.</dd>
                    @endauth
                @endif
            </dl>
        </div>
        <div class="col-3">
            <x-movie-cover :movie="$movie" />
        </div>
    </div>

    <h2 class="mb-3">Sinopsis</h2>
    {{ $movie->synopsis }}

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("<?= $payment->getPublicKey() ?>");
        mp.bricks().create('wallet', 'mercadopago', {
            initialization: {
                preferenceId: "<?= $payment->getPreferenceId() ?>"
            }
        });
    </script>
</article>
