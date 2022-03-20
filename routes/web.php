<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth','prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::resource('countries', \App\Http\Controllers\Admin\CountryController::class);
    Route::resource('jobs', \App\Http\Controllers\Admin\JobController::class);
    Route::post('jobs/media', [\App\Http\Controllers\Admin\JobController::class, 'storeMedia'])->name('jobs.storeMedia');
    Route::get('jobs/mediashow/{mediaItem}', [\App\Http\Controllers\Admin\JobController::class, 'downloadMedia'])->name('jobs.downloadMedia');
    Route::resource('proposals', \App\Http\Controllers\Admin\ProposalController::class);
    Route::post('proposals/media', [\App\Http\Controllers\Admin\ProposalController::class, 'storeMedia'])->name('proposals.storeMedia');
    Route::get('proposals/mediashow/{mediaItem}', [\App\Http\Controllers\Admin\JobController::class, 'downloadMedia'])->name('proposals.downloadMedia');
});

Auth::routes();

