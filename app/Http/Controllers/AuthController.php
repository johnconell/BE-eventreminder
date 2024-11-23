<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import the Hash facade for password verification
use App\Models\User; // Import the User model
use Illuminate\Http\JsonResponse; // Import JsonResponse for returning JSON responses

class AuthController extends Controller
{
    /**
     * Handle the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        // Step 1: Validate the incoming request data
        // Ensure the email field is a valid email address and is not longer than 255 characters
        // Ensure the password is a string with a minimum of 8 characters and a maximum of 255 characters
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        // Step 2: Attempt to retrieve the user by their email address
        // Use the User model to search the database for a user matching the provided email
        $user = User::where('email', $request->email)->first();

        // Step 3: Check if the user exists and verify their password
        // Use the Hash::check method to securely compare the provided password with the hashed password stored in the database
        if (!$user || !Hash::check($request->password, $user->password)) {
            // If the user does not exist or the password does not match, return an unauthorized (401) response
            return response()->json([
                'message' => 'The provided credentials are incorrect', // Error message for invalid login credentials
            ], 401);
        }

        // Step 4: Generate a new personal access token for the authenticated user
        // The token is generated using Laravel Sanctum's `createToken` method
        $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;

        // Step 5: Return a JSON response containing the generated token and a success message
        return response()->json([
            'message' => 'Login Successful', // Success message indicating successful login
            'token_type' => 'Bearer', // Specify the type of token (Bearer token)
            'token' => $token, // Include the generated token in the response
        ], 200); // Return a 200 OK response
    }
}
