<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\http\Controllers\UserController;

Route::get('index', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::post('store', [UserController::class, 'store']);
Route::get('show/{id}', [UserController::class, 'show']);
Route::patch('update/{id}', [UserController::class, 'update']);
Route::delete('destroy/{id}', [UserController::class, 'destroy']);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);