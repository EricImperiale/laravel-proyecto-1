<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
 * Como único requisito de Eloquent, heredamos de la clase "Model".
 */
/**
 * App\Models\Movie
 *
 * @property int $movie_id
 * @property string $title
 * @property int $price
 * @property string $release_date
 * @property string $synopsis
 * @property string|null $cover
 * @property string|null $cover_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCoverDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereSynopsis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereUpdatedAt($value)
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|Movie onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read int|null $genres_count
 * @property int $classification_id
 * @property-read \App\Models\Classification $classification
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereClassificationId($value)
 * @mixin \Eloquent
 */
class Movie extends Model
{
    use SoftDeletes;

    protected $table = 'movies';

    protected $primaryKey = 'movie_id';

    protected $fillable = ['country_id', 'classification_id', 'title', 'price', 'release_date', 'synopsis', 'cover', 'cover_description'];

    protected $hidden = ['created_at', 'updated_at'];

    /*
     |--------------------------------------------------------------------------
     | Métodos de validación.
     |--------------------------------------------------------------------------
     */
    public static function validationRules(): array
    {
        return [
            'title' => 'required|min:2',
            'price' => 'required|numeric',
            'release_date' => 'required',
            'synopsis' => 'required',
            'country_id' => 'required|numeric|exists:countries',
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'title.required' => 'Tenés que escribir el título',
            'title.min' => 'El título tiene que tener al menos 2 caracteres',
            'price.required' => 'Tenés que escribir el precio',
            'price.numeric' => 'El precio tiene que ser un número',
            'release_date.required' => 'Tenés que escribir la fecha de estreno',
            'synopsis.required' => 'Tenés que escribir la sinopsis',
            'country_id.required' => 'Tenés que elegir el país de origen',
            'country_id.numeric' => 'El valor seleccionado para el país de origen no es correcto. Por favor, elegí uno de la lista',
            'country_id.exists' => 'El valor seleccionado para el país de origen no es correcto. Por favor, elegí uno de la lista',
        ];
    }

    public function getGenreIds(): array
    {
        return $this->genres->pluck('genre_id')->all();
    }

    /*
     |--------------------------------------------------------------------------
     | Mutadores.
     |--------------------------------------------------------------------------
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value / 100;
            },
            set: function ($value) {
                return $value * 100;
            }
        );
    }

    protected function releaseDate(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return Carbon::parse($value)->locale(config('app.locale'))->translatedFormat('d M y');
            },
            set: function ($value) {
                return $value;
            },
        );
    }

    /*
     |--------------------------------------------------------------------------
     | Relaciones.
     |--------------------------------------------------------------------------
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }

    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class, 'classification_id', 'classification_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(
            Genre::class,
            'movies_has_genres',
            'movie_id',
            'genre_id',
        );
    }
}
