<?php

use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeamController;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list-staff',[StaffController::class,'getAllStaff'])->name('staff.all');
Route::get('/list-team',[TeamController::class,'getAllTeam'])->name('team.all');
