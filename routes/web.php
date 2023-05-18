<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',function(){

    return view('documentacion');
});

Route::get('reset-password',function(){
    $token = request()->query('token');
    $email = request()->query('email');
    return view('reset-password',compact('token','email'));
})->name('password.reset');

Route::post('update-password/',[UserController::class,'updatePassword'])->name('password.update');