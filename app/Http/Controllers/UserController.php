<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAllUsers()
    {
        try {
            $users = DB::table('users')
                ->select('id', 'name', 'email')
                ->get()
                ->toArray();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'users retrieved successfully',
                    'data' => $users
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

    public function createUser()
    {
        return ['crear usuario'];
    }

    public function editUser($id)
    {
        return $id;
    }

    public function deleteUser($id)
    {
        return $id;
    }

    public function getUserById($id)
    {
        return $id;
    }
}
