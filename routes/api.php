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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'as' => 'admin.'], function () {
    Route::apiResource('permissions', \App\Http\Controllers\Api\V1\Admin\PermissionController::class);
    Route::apiResource('roles', \App\Http\Controllers\Api\V1\Admin\RoleController::class);
    Route::apiResource('users', \App\Http\Controllers\Api\V1\Admin\UserController::class);
    Route::apiResource('countries', \App\Http\Controllers\Api\V1\Admin\CountryController::class);
    Route::apiResource('jobs', \App\Http\Controllers\Api\V1\Admin\JobController::class);
    Route::apiResource('proposals', \App\Http\Controllers\Api\V1\Admin\ProposalController::class);
});
