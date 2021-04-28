<?php

use App\Http\Controllers\FichierController;
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
    return view('index');
})->name('home');

Route::get('/admin', function(){
    return view('admin.index');
})->name('admin.home');

Route::get('/admin/show/fichiers', [FichierController::class,'index'])->name('ad.show.fichiers'); 
Route::post('/admin/store/fichiers', [FichierController::class,'store'])->name('ad.store.fichiers');