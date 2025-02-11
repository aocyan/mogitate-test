<?php

use App\Http\Controllers\ProductController;

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

Route::get('/register', [ProductController::class, 'register']);
Route::post('/register', [ProductController::class, 'store']);

Route::get('/detail', [ProductController::class, 'detail']);

Route::get('/products', [ProductController::class, 'product']);