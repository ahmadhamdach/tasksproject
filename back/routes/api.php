<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register',[UserController::class,'register']); // Singup URL 

Route::post('/reactlogin',[UserController::class,'login']); // lOGIN url

Route::get('alltask/{id}', ['App\Http\Controllers\TasksController', 'getTasks']);
Route::delete('tasks/{id}',['App\Http\Controllers\TasksController', 'deleteTasks']);
Route::put('tasks/{id}',['App\Http\Controllers\TasksController', 'updateTasks']);
Route::post('tasks/',['App\Http\Controllers\TasksController', 'saveTasks']);
Route::get('tasks/{id}', ['App\Http\Controllers\TasksController', 'getSignal']);


// Route::post('/logins',[AuthController::class,'login']);

// Route::get('me', [AuthController::class,'me'])->middleware('jwtauth');

// Route::get('logout', 'AuthController@logout');


// Route::get('refresh', 'AuthController@refresh');
