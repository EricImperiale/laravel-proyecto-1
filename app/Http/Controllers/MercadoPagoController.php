<?php

namespace App\Http\Controllers;

use App\Mail\MovieReserved;
use App\Models\Movie;
use App\PaymentProviders\MercadoPagoPayment;
use App\Repositories\MovieEloquentRepository;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function __construct(
        protected MovieEloquentRepository $repo
    )
    {}

    public function success(Request $request)
    {
        $id = $request->session()->get('movie_id');

        $movie = $this->repo->findOrFail($id);

        return redirect()
            ->route('movies.index')
            ->with('status.message', 'La película <b>' . e($movie->title) . '</b> fue reservada con éxito. Revisa tu email para verificar los detalles.');
    }

    public function pending(Request $request)
    {
        $id = $request->session()->get('movie_id');

        $movie = $this->repo->findOrFail($id);

        return redirect()
            ->route('movies.index')
            ->with('status.message', 'Su reserva de <b>' . e($movie->title) . '</b> está pendiente. Verifica tu email para más información');
    }

    public function failure(Request $request)
    {
        return redirect()
            ->route('movies.index')
            ->with('status.message', 'Ocurrío un error al reservar la película');
    }
}
