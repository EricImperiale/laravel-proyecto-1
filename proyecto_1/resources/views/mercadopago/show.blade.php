<?php
/** @var \App\Models\Movie[]|\Illuminate\Database\Eloquent\Collection $movies */
{{ Session::get('movies_id') }}
?>
@extends('layout.main')

@section('title', 'Prueba de integración de MP')

@section('main')
    <h1>Integración con MP.</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <td>Título</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Subtotal</td>
            </tr>
            </thead>
            @foreach($movies as $movie)
            <tr>
               <td>{{ $movie->title }}</td>
               <td>${{ $movie->price }}</td>
               <td>1</td>
               <td>${{ $movie->price }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div id="mercadopago"></div>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("<?= $payment->getPublicKey(); ?>");
        mp.bricks().create('wallet', 'mercadopago', {
            initialization: {
                preferenceId: "<?= $payment->getPreferenceId(); ?>"
            }
        });
    </script>
@endsection
