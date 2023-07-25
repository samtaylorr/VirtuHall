<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/c/{uuid}', [App\Http\Controllers\ClassroomController::class, 'getClass'])->name('class');
Route::post('/create', [App\Http\Controllers\ClassroomController::class, 'create'])->name('createClass');
Route::post('/join', [App\Http\Controllers\ClassroomController::class, 'join'])->name('joinClass');
Route::post('/upload', [App\Http\Controllers\PythonAPIController::class, 'upload'])->name('upload');