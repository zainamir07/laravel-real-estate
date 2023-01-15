<?php

use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('test', [AuthController::class, 'testApi']);
// Route::get('test/{id?}', [AuthController::class, 'testApi']);
// Route::get('test/{key:name?}', [AuthController::class, 'testApi']);

Route::post('test', [AuthController::class, 'testApi']);