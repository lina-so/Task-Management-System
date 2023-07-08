<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\web\TaskController;
use App\Http\Controllers\web\UserController;






Route::get('/', function () {
    return view('index');
});
/**************************************  project  *****************************************************/
Route::resource('project', App\Http\Controllers\web\ProjectController::class);

/**************************************  users  *****************************************************/
Route::resource('user', UserController::class);

/**************************************  tasks  *****************************************************/
Route::resource('task',TaskController::class);


/**************************************  search for projects  *****************************************************/
Route::get('search', [App\Http\Controllers\web\SearchController::class, 'index'])->name('search');
Route::post('search_result', [App\Http\Controllers\web\SearchController::class, 'search'])->name('search_result');


Route::get('/{page}', [AdminController::class, 'index']);
