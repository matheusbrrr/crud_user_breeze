<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/users', [UserController::class,'index'])->name('users.search');
    Route::resource('/users', UserController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update', 'show']);
    Route::resource('/customers', CustomerController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update', 'show']);
    Route::get('customers/{id}/status', [CustomerController::class, 'status'])->name('customers.status');
    Route::post('customers/{customer}/status', [CustomerController::class, 'updateStatus'])->name('customers.updateStatus');
});

require __DIR__.'/auth.php';
