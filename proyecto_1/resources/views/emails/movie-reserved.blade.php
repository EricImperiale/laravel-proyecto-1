<?php
/** @var \App\Models\Movie $movie */
?>
<!doctype html>mercado
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Película Reservada</title>
</head>
<body>
    <h1>Película Reservada</h1>

    <p>Tu película:</p>

    <x-movie-data :movie="$movie" />

    <p>Fue reservada con éxito.</p>

    <p>Guardá este email para cualquier eventualidad.</p>

    <p>Saludos,<br> Películas.</p>
</body>
</html>
