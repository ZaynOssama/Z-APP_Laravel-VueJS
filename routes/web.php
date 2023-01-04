<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/zaynsworld', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('zaynsworld');

Route::get('/admin', function () {
    return view('admin/dashboard');
})->middleware(['auth.admin', 'verified'])->name('admin.index');

Route::get('/users', function () {
    return view('admin/users/index');
})->middleware(['auth.admin', 'verified'])->name('users.index');

Route::get('/users-data', [UsersController::class, 'allUsers'])->name('users-data');

Route::post('/new-user', [UsersController::class, 'store'])->name('new-user');

Route::put('/edit-user/{idUser}', [UsersController::class, 'update'])->name('edit-user');

Route::delete('/delete-user/{idUser}', [UsersController::class, 'destroy'])->name('delete-user');

Route::get('/users_data', [UsersController::class, 'index'])->name('users.data');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// This is for testing purposes, not for production.//
//Comment the next route if the app is not working//
/*Route::view('/{any}', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->where('any', '.*');
*/
require __DIR__.'/auth.php';
