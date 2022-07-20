<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function getAllTasks()
    {
        try {

            Log::info("Getting all Tasks");

            $tasks = DB::table('tasks')
                ->select('id', 'title', 'user_id', 'duration')
                ->get()
                ->toArray();

            //Ejemplo si quisiera hacer la llamada desde el modelo (forma correcta)
            //$tasks = Task::query()->get()->toArray();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'tasks retrieved successfully',
                    'data' => $tasks
                ],
                200
            );
        } catch (\Exception $exception) {

            Log::error("Error getting task: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => true,
                    'message' => "Error getting tasks"
                ],
                500
            );
        }
    }
    public function createTask(Request $request)
    {
        try {
            Log::info("Creating Task");

            $title = $request->input('title');
            $userId = $request->input('user_id');
            $duration = $request->input('duration');

            $task = new Task();
            $task->title = $title;
            $task->user_Id = $userId;
            $task->duration = $duration;

            $task->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Task created"
                ],
                200
            );
        
        } catch (\Exception $exception) {

            Log::error("Error creating task: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => true,
                    'message' => "Error creating tasks"
                ],
                500
            );
        }
    }

    public function editTask($id)
    {
        return $id;
    }

    public function deleteTask($id)
    {
        return $id;
    }

    public function getTaskById($id)
    {
        try {
            $tasks = Task::query()->findOrFail($id)->toArray();

            return $tasks;
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Error retrieving: ' . $exception->getMessage()
                ],
                500
            );
        }
    }
}
