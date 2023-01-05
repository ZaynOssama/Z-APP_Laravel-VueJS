<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\CustomerTasksController;

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
    return view('customer/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/my-tasks', function () {
    return view('customer/tasks/index');
})->middleware(['auth', 'verified'])->name('my-tasks');

Route::get('/my-tasks-data', [CustomerTasksController::class, 'allTasks'])->name('my-tasks-data');

Route::post('/my-new-task', [CustomerTasksController::class, 'store'])->name('my-new-task');

Route::put('/edit-my-task/{idTask}', [CustomerTasksController::class, 'update'])->name('edit-my-task');

Route::delete('/delete-my-task/{idTask}', [CustomerTasksController::class, 'destroy'])->name('delete-my-task');

Route::get('/admin', function () {
    return view('admin/dashboard');
})->middleware(['auth.admin', 'verified'])->name('admin.index');

Route::get('/users', function () {
    return view('admin/users/index');
})->middleware(['auth.admin', 'verified'])->name('users.index');

Route::get('/tasks', function () {
    return view('admin/tasks/index');
})->middleware(['auth.admin', 'verified'])->name('tasks.index');

Route::get('/users-data', [UsersController::class, 'allUsers'])->name('users-data');

Route::post('/new-user', [UsersController::class, 'store'])->name('new-user');

Route::put('/edit-user/{idUser}', [UsersController::class, 'update'])->name('edit-user');

Route::delete('/delete-user/{idUser}', [UsersController::class, 'destroy'])->name('delete-user');

Route::get('/tasks-data', [TasksController::class, 'allTasks'])->name('tasks-data');

Route::post('/new-task', [TasksController::class, 'store'])->name('new-task');

Route::put('/edit-task/{idTask}', [TasksController::class, 'update'])->name('edit-task');

Route::delete('/delete-task/{idTask}', [TasksController::class, 'destroy'])->name('delete-task');

// Route::get('/users_data', [UsersController::class, 'index'])->name('users.data');

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
