<?php

use App\Http\Controllers\TasksController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
Route::get('/tasks/list', [TasksController::class, 'getTasks'])->name('tasks.list');
Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{tasks}/edit', [TasksController::class, 'show'])->name('tasks.edit');
Route::put('/tasks/{tasks}', [TasksController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{tasks}', [TasksController::class, 'destroy'])->name('tasks.destroy');
