<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/**************************************  project  *****************************************************/

Route::apiResource('project', ProjectController::class);

/**************************************  users  *****************************************************/
Route::apiResource('user', UserController::class);

/**************************************  tasks  *****************************************************/
Route::apiResource('task', TaskController::class);

/**************************************  search  *****************************************************/

Route::post('search_result', [App\Http\Controllers\Api\SearchController::class, 'search'])->name('search_result');
