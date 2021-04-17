<?php

use App\Http\Controllers\ChamadoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function(){
    Route::get('/chamados/atender', [ChamadoController::class, 'antenderChamado'])->name('atender.chamados');
    Route::get('/chamados/create', [ChamadoController::class, 'create'])->name('chamados.create');
    Route::post('/chamados/create', [ChamadoController::class, 'store'])->name('chamados.store');    
    Route::get('/chamados', [ChamadoController::class, 'index'])->name('chamados.index');
    Route::get('/chamados/{id}', [ChamadoController::class, 'show'])->name('chamados.show');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
