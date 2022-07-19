<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function getAllTasks()
    {
        try {
            $tasks = DB::table('tasks')
                ->select('id', 'title', 'user_id', 'duration')
                ->get()
                ->toArray();

            //Ejemplo si quisiera hacer la llamada desde el modelo
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
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Error retrieving: ' . $exception->getMessage()
                ],
                500
            );
        }
    }
    public function createTask()
    {
        return ['crear tarea'];
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
