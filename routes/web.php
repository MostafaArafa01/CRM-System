<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::redirect('/','/login');

Route::resource('/user',UserController::class);
Route::resource('/client',ClientController::class);
Route::resource('/project',ProjectController::class);
Route::resource('/task',TaskController::class);

