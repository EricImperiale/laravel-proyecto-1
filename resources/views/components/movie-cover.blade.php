<?php
use Illuminate\Support\Facades\Storage;
/** @var \App\Models\Movie $movie */
/** @var string|null $alt */
?>
<div>
    @if($movie->cover !== null && Storage::has('imgs/' . $movie->cover))
        <img src="{{ Storage::url('imgs/' . $movie->cover) }}" alt="{{ $alt ?? $movie->cover_description }}" class="mw-100">
    @else
        <p>No hay portada.</p>
    @endif
</div>
