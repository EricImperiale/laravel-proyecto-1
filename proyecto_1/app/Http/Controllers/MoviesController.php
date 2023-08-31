<?php
// TODO:
// Hacer solamente, por ahora, que devuelva el mensaje de que se reservo con exíto.
// Después vemos como hacer para que se envíe el email.
// También podríamos ver como hacer para recuperar password.
namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepository;
use App\Repositories\MovieEloquentRepository;
use App\Searches\MovieSearchParams;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\PaymentProviders\MercadoPagoPayment;

class MoviesController extends Controller
{
    public function __construct(
        protected MovieRepository $repo,
        protected MoviesReservationController $moviesReservationController
    )
    {}

    public function index(Request $request)
    {
        $searchParams = $request->query('t');

        $movies = $this->repo->withRelations(['country', 'classification', 'genres'], $searchParams);

        return view('movies.index', [
            'movies' => $movies,
            'searchParams' => $searchParams
        ]);
    }

    public function view(Request $request, int $id)
    {
        $movie = $this->repo->findOrFail($id);

        $payment = new MercadoPagoPayment();

        $payment
            ->addItem($movie)
            ->withBackUrls(
                success: route('mp.success'),
                pending: route('mp.pending'),
                failure: route('mp.failure'),
            )
            ->withAutoReturn()
            ->saveMovieIdToSession($request, $id)
            ->save();

        return view('movies.view', [
            'movie' => $movie,
            'payment' => $payment,
        ]);
    }

    public function formNew()
    {
        return view('movies.create-form', [
            'countries' => Country::orderBy('name')->get(),
            'classifications' => Classification::orderBy('name')->get(),
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function processNew(Request $request)
    {
        $data = $request->except(['_token']);

        $request->validate(Movie::validationRules(), Movie::validationMessages());

        if($request->hasFile('cover')) {
            $data['cover'] = $this->uploadCover($request);
        }

        try {
          DB::beginTransaction();

          $this->repo->create($data);

          DB::commit();
        } catch(\Exception $e) {
            //Debugbar::log($e);
            DB::rollBack();

            return redirect()
                ->route('movies.formNew')
                ->withInput()
                ->with('status.message', 'Ocurrió un error al grabar la información. Por favor, probá de nuevo en un rato. Si el problema persiste, comunicate con nosotros.')
                ->with('status.type', 'error');
        }

        return redirect()
            ->route('movies.index')
            ->with('status.message', 'La película <b>' . e($data['title']) . '</b> fue publicada con éxito.');
    }

    public function formUpdate(int $id)
    {
        return view('movies.update-form', [
            'movie' => Movie::findOrFail($id),
            'countries' => Country::orderBy('name')->get(['country_id', 'name']),
            'classifications' => Classification::orderBy('name')->get(['classification_id', 'name']),
            'genres' => Genre::orderBy('name')->get(['genre_id', 'name']),
        ]);
    }

    public function processUpdate(int $id, Request $request)
    {
        $movie = Movie::findOrFail($id);

        $request->validate(Movie::validationRules(), Movie::validationMessages());

        $data = $request->except(['_token']);

        if($request->hasFile('cover')) {
            $data['cover'] = $this->uploadCover($request);

            $oldCover = $movie->cover;
        }

        try {
            DB::beginTransaction();

            $movie->update($data);
            $movie->genres()->sync($data['genre_id'] ?? []);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('movies.formUpdate', ['id' => $movie->movie_id])
                ->withInput()
                ->with('status.message', 'Ocurrió un error al actualizar la información. Por favor, probá de nuevo en un rato. Si el problema persiste, comunicate con nosotros.')
                ->with('status.type', 'error');
        }

        $this->deleteCover($oldCover ?? null);

        return redirect()
            ->route('movies.index')
            ->with('status.message', 'La película <b>' . e($movie->title) . '</b> fue editada con éxito.');
    }

    public function confirmDelete(int $id)
    {
        return view('movies.confirm-delete', [
            'movie' => Movie::findOrFail($id),
        ]);
    }

    public function processDelete(int $id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        $this->deleteCover($movie->cover);

        return redirect()
            ->route('movies.index')
            ->with('status.message', 'La película <b>' . e($movie->title) . '</b> fue eliminada con éxito.');
    }
    protected function uploadCover(Request $request): string
    {
        $cover = $request->file('cover');

        $coverName = date('YmdHis-') . \Str::slug($request->input('title')) . "." . $cover->guessExtension();

        $cover->storeAs('imgs', $coverName);

        return $coverName;
    }
    protected function deleteCover(?string $cover): void
    {
        if($cover !== null && Storage::has('imgs/' . $cover)) {
            Storage::delete('imgs/' . $cover);
        }
    }
}
