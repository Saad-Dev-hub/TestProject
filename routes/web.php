<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('upload-products', [ProductController::class,'store'])->name('upload-products');
    //logout
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
});
//route middleware guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login',[LoginController::class,'authenticate']);
    Route::get('/register',[RegisterController::class,'index'])->name('register');
    Route::post('/register',[RegisterController::class,'store']);
});

