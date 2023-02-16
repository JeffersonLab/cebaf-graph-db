<?php

use App\Http\Controllers\DataSetController;
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
    return redirect()->route('data-sets.index');
});

Route::resource('data-sets', DataSetController::class);

Route::get('data-sets/{data_set}/zip', [DataSetController::class, 'zip'])->name('data-sets.zip');
