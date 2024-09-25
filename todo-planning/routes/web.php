<?php

use Illuminate\Support\Facades\Route;
// routes/api.php
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('api/tasks', [TaskController::class, 'index']);
