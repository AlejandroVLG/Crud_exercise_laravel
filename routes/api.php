<?php

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

Route::get('/', function(){
    return['Bienvenido a mi aplicación'];
});

Route::get('/users', function(){
    return['get'];
});

Route::post('/users', function(){
    return['post'];
});

Route::put('/users', function(){
    return['update'];
});

Route::delete('/users', function(){
    return['delete'];
});

Route::get('/users/{id}', function($id){
    return $id;
});
