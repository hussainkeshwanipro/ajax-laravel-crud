<?php

use App\Http\Controllers\AjaxController;
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
    return view('form');
});



Route::get('getAllData', [AjaxController::class, 'getAllData'])->name('getAllData');

Route::post('form_submit', [AjaxController::class, 'form_submit'])->name('form_submit');



Route::get('edit/{id}', [AjaxController::class, 'getData']);

Route::put('update', [AjaxController::class, 'updateForm'])->name('updateForm');

Route::delete('delete/{id}', [AjaxController::class, 'deleteForm']);