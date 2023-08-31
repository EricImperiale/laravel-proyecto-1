<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            [
                'movie_id' => 1,
                'country_id' => 2,
                'classification_id' => 1,
                'title' => 'El Señor de los Anillos: La Comunidad del Anillo',
                'release_date' => '2001-12-21',
                'price' => 149999,
                'synopsis' => 'Un tipos de baja estatura se lleva un anillo para reventarlo en un volcán.',
                'cover' => 'lotr-cover.jpg',
                'cover_description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 2,
                'country_id' => 3,
                'classification_id' => 1,
                'title' => 'El Discurso del Rey',
                'release_date' => '2010-07-18',
                'price' => 129999,
                'synopsis' => '\'I have a voice!\'',
                'cover' => null,
                'cover_description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 3,
                'country_id' => 2,
                'classification_id' => 2,
                'title' => 'Matrix',
                'release_date' => '1999-12-10',
                'price' => 89999,
                'synopsis' => '\'Mr. Anderson\'',
                'cover' => 'matrix-cover.jpg',
                'cover_description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 4,
                'country_id' => 2,
                'classification_id' => 4,
                'title' => 'Rescatando al Soldado Ryan',
                'release_date' => '2002-07-21',
                'price' => 59999,
                'synopsis' => 'Clásico de la 2da Guerra Mundial',
                'cover' => null,
                'cover_description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('movies_has_genres')->insert([
            [
                'movie_id' => 1,
                'genre_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 1,
                'genre_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 2,
                'genre_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 3,
                'genre_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 3,
                'genre_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 4,
                'genre_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id' => 4,
                'genre_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
