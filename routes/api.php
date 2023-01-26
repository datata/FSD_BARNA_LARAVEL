<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Http\Request;
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

Route::get('/welcome', function () {
    return 'Bienvenidos a mi aplicacion de tareas';
});

Route::post('/tasks', [TaskController::class, 'createTask']);

Route::put('/tasks/{id}', function ($id) {
    return 'Actualizar Tarea ' . $id;
});

Route::delete('/tasks/{id}', function ($id) {
    return 'Eliminar Tarea: ' . $id;
});

Route::get('/tasks/{id}', [TaskController::class, 'getTaskById']);

Route::get('/tasks', [TaskController::class, 'getAllTasks']);
