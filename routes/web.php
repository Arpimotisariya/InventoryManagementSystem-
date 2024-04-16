<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

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
    return redirect()->route('index');
});

Route::get('index', [InventoryController::class, 'index' ])->name('index');
Route::get('create', [InventoryController::class, 'create' ])->name('create');
Route::post('store', [InventoryController::class, 'store'])->name('store');
Route::get('inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
Route::delete('inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
Route::get('show', [InventoryController::class, 'show'])->name('show');