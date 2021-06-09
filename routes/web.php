<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RecetaController;
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

Route::get('/', [InicioController::class, 'index'])->name('name.index');
Route::get('/categoria/{categoria}', [CategoriaController::class, 'show'])->name('categoria.show');


Route::get('/buscar', [RecetaController::class, 'search'])->name('buscar.show');


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::resource('/recetas', RecetaController::class);
Route::resource('/perfils', PerfilController::class)->except([
    'index', 'store', 'create'
]);

Route::post('/recetas/{receta}', [LikeController::class, 'update'])->name('likes.update');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
