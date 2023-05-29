<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [MainController::class, 'login']);

Route::get('/myTeam', [MainController::class, 'myTeam']);

Route::middleware(['is.token'])->group(function () {
    Route::get('/teams', [MainController::class, 'getTeams']);
    Route::post('/teams', [MainController::class, 'setTeam']);
    Route::put('/teams/{team}', [MainController::class, 'editTeam']);
    Route::delete('/teams/{team}', [MainController::class, 'deleteTeam']);
});
