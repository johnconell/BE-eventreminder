<?php

use Illuminate\Support\Facades\Route; // Import the Route facade for defining routes
use App\Http\Controllers\AuthController; // Import the AuthController for authentication-related routes
use App\Http\Controllers\UserController; // Import the UserController for user-related routes


// Route for user login
// POST /login: This route handles user login requests
// Calls the 'login' method in the AuthController
Route::post('/login', [AuthController::class, 'login']);

// Route for fetching the list of users
// GET /users: This route retrieves a list of all users
// Calls the 'users' method in the UserController
Route::get('/users', [UserController::class, 'users']);
