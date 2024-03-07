<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

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

// THỨ TỰ ROUTE VỚI CONTROLLER
// Route::get('cars', [CarController::class, 'index']);
// Route::get('cars/create', [CarController::class, 'create']);
// Route::post('cars', [CarController::class, 'store']);


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/allcar', [CarController::class, 'index']);
// Route::get('/car-detail/{id}', [CarController::class, 'show'])->name('car-detail');
Route::resource('cars', CarController::class);


