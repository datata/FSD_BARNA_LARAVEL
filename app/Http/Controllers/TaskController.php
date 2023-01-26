<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {
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

            if(!$task) {
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
}
