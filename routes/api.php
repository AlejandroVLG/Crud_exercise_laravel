<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return ['YEEEPA'];
});

/* ---------------------------USERS--------------------------- */

Route::get('/users', [UserController::class, 'getAllUsers']);

Route::post('/users', [UserController::class, 'createUser']);

Route::put('/users/{id}', [UserController::class, 'editUser']);

Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

Route::get('/users/{id}', [UserController::class, 'getUserById']);

/* ---------------------------TASKS--------------------------- */

Route::get('/tasks', [TaskController::class, 'getAllTasks'])->middleware('middlewareExample');

Route::post('/tasks', [TaskController::class, 'createTask']);

Route::put('/tasks/{id}', [TaskController::class, 'editTask']);

Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask']);

Route::get('/tasks/{id}', [TaskController::class, 'getTaskById']);
