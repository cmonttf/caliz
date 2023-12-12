<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TransbankController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/', WelcomeController::class);
Route::post('/welcome-show', [WelcomeController::class, 'show'])->name('welcome-show');
//Route::post('/redirigir', [WelcomeController::class, 'redirigir']);


Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('persons', PersonController::class);
    Route::post('import/import', [ImportController::class, 'import'])->name('import.import');
    Route::get('import/import', [ImportController::class, 'showImportForm'])->name('import.import.form');
    Route::resource('pagos', PagoController::class);
    Route::get('/obtener-monto/{id}', [PaymentsController::class, 'obtenerMonto']);
});
