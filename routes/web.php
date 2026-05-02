<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('home');
Route::post('/add', [TaskController::class, 'addTask'])->name('task.add');
Route::put('/update', [TaskController::class, 'updateTask'])->name('task.update');
Route::delete('/delete/{task}', [TaskController::class, 'deleteTask'])->name('task.delete');
