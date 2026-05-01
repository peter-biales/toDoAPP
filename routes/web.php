<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'getAllTasks'])->name('home');
Route::delete('/delete/{task}', [TaskController::class, 'deleteById'])->name('task.delete');

Route::get('/task', [TaskController::class, 'edit'])->name('task.edit');
