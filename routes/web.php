<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgenteController;
use App\Http\Controllers\ArmaController;
use App\Http\Controllers\UltimateController;

/*
|--------------------------------------------------------------------------
| rotas de login
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| rotas do painel
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('agentes', AgenteController::class)->except('show');
    Route::resource('armas', ArmaController::class)->except('show');
    Route::resource('ultimates', UltimateController::class)->except('show');
});
