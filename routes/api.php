<?php

use App\Http\Controllers\API\AlquilerController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\API\MultaController;
use App\Http\Controllers\API\PeliculaController;
use App\Http\Controllers\API\SucursalController;
use App\Http\Controllers\API\UserController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('login',function(){

    $baseController = new BaseController();

    return $baseController->sendError("Debe iniciar sesión para hacer cualquier petición.");

});

Route::post('login', [AuthController::class, 'signin'])->name('login');
Route::post('register', [AuthController::class, 'signup']);

Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

Route::middleware('auth:sanctum')->group( function () {
    
    Route::post('logout', [AuthController::class, 'signout']);

    Route::resource('usuarios', UserController::class);
    Route::resource('sucursales', SucursalController::class);
    Route::resource('peliculas', PeliculaController::class);
    Route::resource('multas', MultaController::class);
    Route::resource('alquileres', AlquilerController::class);

});