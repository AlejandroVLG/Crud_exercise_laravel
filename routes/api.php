<?php

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

Route::get('/users', function () {
    try {
        $users = DB::table('users')
            ->select('id', 'name', 'email', 'title')
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
                'message' => 'Error retrieving: '.$exception->getMessage()
            ],
            500
        );
    }
});

Route::post('/users', function () {
    return ['post'];
});

Route::put('/users', function () {
    return ['update'];
});

Route::delete('/users', function () {
    return ['delete'];
});

Route::get('/users/{id}', function ($id) {
    return $id;
});
