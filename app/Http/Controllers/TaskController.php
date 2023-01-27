<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:8',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }
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
                "message" => "Error creating task: " . $th->getMessage()
            ], 500);
        }
    }

    public function getAllTasks()
    {
        try {
            $tasks = Task::query()->get();

            return response([
                "success" => true,
                "message" => "Get Tasks retrieved successfully",
                "data" => $tasks
            ], 200);
        } catch (\Throwable $th) {
            return response([
                "success" => false,
                "message" => "Error retrieving tasks: " . $th->getMessage()
            ], 500);
        }
    }

    public function getTaskById($id)
    {
        try {
            $task = Task::query()->find($id);

            if (!$task) {
                return response([
                    "success" => true,
                    "message" => "Task doesnt exists",
                    "data" => $task
                ], 404);
            }

            return response([
                "success" => true,
                "message" => "Get Task by id retrieved successfully",
                "data" => $task
            ], 200);
        } catch (\Throwable $th) {
            return response([
                "success" => false,
                "message" => "Error retrieving task: " . $th->getMessage()
            ], 500);
        }
    }

    public function updateTaskById(Request $request, $id)
    {
        try {
            //Recuperar tarea
            $task = Task::query()->find($id);

            // Valido si la tarea existe en bd
            if (!$task) {
                return response([
                    "success" => true,
                    "message" => "Task doesnt exists",
                    "data" => $task
                ], 404);
            }

            // Recuperamos la informacion a modificar del body a traves del objeto request
            $title = $request->input('title');
            $description = $request->input('description');

            // Actualizamos la tarea
            if (isset($title)) {
                $task->title = $title;
            }

            if (isset($description)) {
                $task->description = $description;
            }
            // actualiza en bd
            $task->save();

            return response([
                "success" => true,
                "message" => "Task updated successfully",
                "data" => $task
            ], 200);
        } catch (\Throwable $th) {
            return response([
                "success" => false,
                "message" => "Error updating task: " . $th->getMessage()
            ], 500);
        }
    }
}
