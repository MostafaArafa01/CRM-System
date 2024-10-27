<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\TaskController;



Route::apiResource('/user',UserController::class)->middleware('auth:sanctum');
Route::apiResource('/task',TaskController::class);
Route::apiResource('/project',ProjectController::class)->middleware('auth:sanctum');
Route::apiResource('/client',ClientController::class)->middleware('auth:sanctum');
Route::get('/getuser',[UserController::class,'getCurrentUser'])->middleware('auth:sanctum');
Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LogoutController::class,'logout'])->middleware('auth:sanctum');



