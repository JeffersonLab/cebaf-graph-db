<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DataSetController;
use App\Http\Controllers\ProfileController;
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
    return redirect()->route('data-sets.index');
});

//Route::get('data-sets/create', \App\Livewire\DataSetForm::class)->name('data-sets.create');
//Route::get('data-sets/create', [DataSetController::class, 'create'])->name('data-sets.create');
//Route::get('data-sets', [DataSetController::class, 'index'])->name('data-sets.index');
//Route::post('data-sets', [DataSetController::class, 'store'])->name('data-sets.store');
//Route::get('data-sets/{data_set}', [DataSetController::class, 'show'])->name('data-sets.show');

//Routes
Route::resource('data-sets', DataSetController::class);
//Route::get('data-sets/{data_set}/zip', [DataSetController::class, 'zip'])->name('data-sets.zip');


// Configs
Route::resource('configs', ConfigController::class);













require __DIR__.'/auth.php';
