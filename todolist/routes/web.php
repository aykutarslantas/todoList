<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');;
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::put('/updateTitle/{id}', [TaskController::class, 'updateTitle']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
