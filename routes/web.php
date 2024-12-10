<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware("auth")->group(function () {
    Route::get('/', function () {
        return redirect()->route('todos.index');
    });

    Route::get('/todos/{id}/delete', [TodoController::class, 'delete']);

    Route::get('/todos/{id}/update', [TodoController::class, 'halaman_update']);
    Route::post('/todos/{id}/update', [TodoController::class, 'update']);

    // menampilkan halaman create
    Route::get('/todos/create', [TodoController::class, 'halaman_create']);
    Route::post('/todos/create', [TodoController::class, 'create']);

    // read banyak
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    // read satu
    Route::get('/todos/{id}', [TodoController::class, 'detailTodo']);
});