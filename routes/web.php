<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\MoviesTrashedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfirmAgeController;
use App\Http\Controllers\MoviesReservationController;
use App\Http\Controllers\MercadoPagoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])
    ->name('home');

/*
 |--------------------------------------------------------------------------
 | Autenticación.
 |--------------------------------------------------------------------------
 */
Route::get('iniciar-sesion', [AuthController::class, 'formLogin'])
    ->name('auth.formLogin');
Route::post('iniciar-sesion', [AuthController::class, 'processLogin'])
    ->name('auth.processLogin');
Route::post('cerrar-sesion', [AuthController::class, 'processLogout'])
    ->name('auth.processLogout');

/*
 |--------------------------------------------------------------------------
 | Películas
 |--------------------------------------------------------------------------
 */
Route::get('peliculas/listado', [MoviesController::class, 'index'])
    ->name('movies.index');

Route::middleware(['auth'])->group(function() {
    Route::get('peliculas/eliminadas', [MoviesTrashedController::class, 'index'])
        ->name('movies.trashed.index');

    Route::get('peliculas/nueva', [MoviesController::class, 'formNew'])
        ->name('movies.formNew');

    Route::post('peliculas/nueva', [MoviesController::class, 'processNew'])
        ->name('movies.processNew');

    Route::get('peliculas/{id}/editar', [MoviesController::class, 'formUpdate'])
        ->name('movies.formUpdate')
        ->middleware(['auth'])
        ->where('id', '[0-9]+');;

    Route::post('peliculas/{id}/editar', [MoviesController::class, 'processUpdate'])
        ->name('movies.processUpdate')
        ->middleware(['auth'])
        ->where('id', '[0-9]+');;

    Route::get('peliculas/{id}/eliminar', [MoviesController::class, 'confirmDelete'])
        ->name('movies.confirmDelete')
        ->middleware(['auth'])
        ->where('id', '[0-9]+');;

    Route::post('peliculas/{id}/eliminar', [MoviesController::class, 'processDelete'])
        ->name('movies.processDelete')
        ->middleware(['auth'])
        ->where('id', '[0-9]+');;

    Route::get('admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
});

Route::get('peliculas/{id}', [MoviesController::class, 'view'])
    ->name('movies.view')
    ->middleware(['mayoria-de-edad'])
    ->where('id', '[0-9]+');;

/*
 |--------------------------------------------------------------------------
 | Verificación de mayoría de edad.
 |--------------------------------------------------------------------------
 */

Route::get('peliculas/{id}/confirmar-edad', [ConfirmAgeController::class, 'formConfirmation'])
    ->name('confirm-age.formConfirmation')
    ->where('id', '[0-9]+');;

Route::post('peliculas/{id}/confirmar-edad', [ConfirmAgeController::class, 'processConfirmation'])
    ->name('confirm-age.processConfirmation')
    ->where('id', '[0-9]+');;

/*
 |--------------------------------------------------------------------------
 | Rutas para reservar películas.
 |--------------------------------------------------------------------------
 */

Route::post('peliculas/{id}/reservar', [MoviesReservationController::class, 'processReservation'])
    ->name('movies.processReservation')
    ->where('id', '[0-9]+');;

Route::get('peliculas/eliminadas/{id}/eliminar', [MoviesTrashedController::class, 'confirmDelete'])
    ->name('movies.trashed.confirmDelete')
    ->where('id', '[0-9]+');;

Route::post('peliculas/eliminadas/{id}/eliminar', [MoviesTrashedController::class, 'processDelete'])
    ->name('movies.trashed.processDelete')
    ->where('id', '[0-9]+');;

/*
 |--------------------------------------------------------------------------
 | Mercadopago.
 |--------------------------------------------------------------------------
 */
Route::get('mp/success', [MercadoPagoController::class, 'success'])->name('mp.success');

Route::get('mp/pending', [MercadoPagoController::class, 'pending'])->name('mp.pending');

Route::get('mp/failure', [MercadoPagoController::class, 'failure'])->name('mp.failure');

/*
 |--------------------------------------------------------------------------
 | 404.
 |--------------------------------------------------------------------------
 */
Route::fallback(function(){
   return view('404');
});
