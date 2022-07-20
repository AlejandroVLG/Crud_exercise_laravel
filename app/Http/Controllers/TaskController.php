<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    /* ---------------------------GET TASK--------------------------- */

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
                    'success' => false,
                    'message' => "Error getting tasks"
                ],
                500
            );
        }
    }

    /* ---------------------------CREATE TASK--------------------------- */

    public function createTask(Request $request)
    {
        try {
            Log::info("Creating Task");

            $validator = Validator::make($request->all(), [
                'title' => ['required', 'string', 'min:3', 'max:10'],
                'user_id' => 'required | integer',  // El | es otra forma que hace 
                'duration' => ['required', 'string'] //lo mismo que meterlo dentro de []
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => $validator->errors()
                    ],
                    400
                );
            }

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
                    'success' => false,
                    'message' => "Error creating tasks"
                ],
                500
            );
        }
    }

    /* ---------------------------EDIT TASK--------------------------- */

    public function editTask(Request $request, $id)
    {
        try {
            Log::info('Updating task');

            $validator = Validator::make($request->all(), [
                'title' => ['string',],
                'user_id' => ['integer'],
                'status' => ['boolean'],  // El | es otra forma que hace 
                'duration' => ['string']  //lo mismo que meterlo dentro de []
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => $validator->errors()
                    ],
                    400
                );
            }

            $task = Task::find($id);

            if (!$task) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Task doesn't exists"
                    ],
                    404
                );
            }
            $title = $request->input('title');
            $status = $request->input('status');
            $duration = $request->input('duration');

            if (isset($title)) {
                $task->title = $title;
            };

            if (isset($status)) {
                $task->status = $status;
            };

            if (isset($duration)) {
                $task->duration = $duration;
            };

            $task->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Task " . $id . " changed"
                ],
                200
            );
        } catch (\Exception $exception) {

            Log::error("Error changing a task: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error changing a task"
                ],
                500
            );
        }
    }

    /* ---------------------------DELETE TASK--------------------------- */

    public function deleteTask($id)
    {
        try {
            Log::info('Deleting a task');

            $task = Task::find($id);

            if (!$task) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Task doesn't exists"
                    ],
                    404
                );
            }

            $task->delete($id);

            return response()->json(
                [
                    'success' => true,
                    'message' => "Task " . $id . " deleted"
                ],
                200
            );
        } catch (\Exception $exception) {

            Log::error("Error deleting a task: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error deleting a task"
                ],
                500
            );
        }
    }

    /* ---------------------------GET TASK BY ID--------------------------- */

    public function getTaskById($id)
    {
        try {
            Log::info('get task by id');

            $tasks = Task::query()->findOrFail($id)->toArray();

            return $tasks;

        } catch (\Exception $exception) {

            Log::error("Error getting a task by id: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error getting a task by id"
                ],
                500
            );
        }
    }
}
