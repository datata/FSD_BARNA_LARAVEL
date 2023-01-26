<?php

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

Route::post('/tasks', function (Request $request) {
    try {
        //Recuperar informacion del body
        $title = $request->input('title');
        $description = $request->input('description');

        //Guardar en bd la nueva tarea
        $task = new Task();
        $task->title = $title;
        $task->description = $description;
        $task->save();

        // response
        return response([
            "success" => true,
            "message" => "Task created successfuly",
            "data" => $task
        ], 200);
    } catch (\Throwable $th) {
        return response([
            "success" => false,
            "message" => "Error creating task: ".$th->getMessage()
        ], 500);
    }
});

Route::put('/tasks/{id}', function ($id) {
    return 'Actualizar Tarea ' . $id;
});

Route::delete('/tasks/{id}', function ($id) {
    return 'Eliminar Tarea: ' . $id;
});

Route::get('/tasks/{id}', function ($id) {
    return 'Recuperar Tarea por id: ' . $id;
});

Route::get('/tasks', function () {
    return 'Recuperar todas las tareas';
});
