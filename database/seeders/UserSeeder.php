<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash; // Import Hash facade for password hashing

class UserSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'admin', // Name of the admin user
            'email' => 'admin@gmail.com', // Email of the admin user
            'password' => Hash::make('12345678'), // Securely hash the password for the admin user
        ]);

        // Step 2: Generate 20 random users using the User factory
        User::factory()->count(20)->create();
    }
}
