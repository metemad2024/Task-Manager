<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post("registeradmin", [ApiController::class, "registeradmin"]);
Route::post("login", [ApiController::class, "login"]);

Route::group([
    "middleware" => ["auth:api"]
], function(){
    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("logout", [ApiController::class, "logout"]);
    Route::post("adduser", [ApiController::class, "addUser"]);
    Route::post("edituser", [ApiController::class, "editUser"]);
    Route::post("deleteuser", [ApiController::class, "deleteUser"]);
    Route::post("addtask", [ApiController::class, "addTask"]);
    Route::post("edittask", [ApiController::class, "editTask"]);
    Route::post("deletetask", [ApiController::class, "deleteTask"]);
    Route::post("addtaskforothers", [ApiController::class, "addTaskForOthers"]);
    Route::post("tasklist", [ApiController::class, "taskList"]);
    Route::post("userlist", [ApiController::class, "userList"]);
});