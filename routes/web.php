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
Route::get('data-sets/create', [DataSetController::class, 'create'])->name('data-sets.create');
Route::get('data-sets', [DataSetController::class, 'index'])->name('data-sets.index');
Route::post('data-sets', [DataSetController::class, 'store'])->name('data-sets.store');
Route::get('data-sets/{data_set}', [DataSetController::class, 'show'])->name('data-sets.show');

// Configs
Route::resource('configs', ConfigController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//Route::resource('data-sets', DataSetController::class);

//Route::get('data-sets/{data_set}/zip', [DataSetController::class, 'zip'])->name('data-sets.zip');










require __DIR__.'/auth.php';
