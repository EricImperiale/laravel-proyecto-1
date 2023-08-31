<?php

namespace App\Http\Middleware;

use App\Models\Movie;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarMayoriaDeEdad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->session()->get('ageVerified', false)) return $next($request);

        $id = $request->route()->parameter('id');
        $movie = Movie::findOrFail($id);

        if($movie->classification_id === 4) {
            return redirect()
                ->route('confirm-age.formConfirmation', ['id' => $id]);
        }

        return $next($request);
    }
}
