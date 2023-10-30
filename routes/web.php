<?php

use App\Livewire\CategoryComponent;
use App\Livewire\ChartComponent;
use App\Livewire\ProductComponent;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('categories', CategoryComponent::class)->middleware('auth');
Route::get('productos', ProductComponent::class)->middleware('auth');
Route::get('charts', ChartComponent::class)->middleware('auth');
Route::get('/pdf/categorias/{id}', [CategoryComponent::class, 'GenerarReporteUnico'])->middleware('auth');
Route::get('/pdf/productos/{id}', [ProductComponent::class, 'GenerarReporteUnico'])->middleware('auth');
Route::get('/genera/qr/{id}', [ProductComponent::class, 'GenerarQR'])->middleware('auth');
