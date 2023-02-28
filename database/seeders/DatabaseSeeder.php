<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $email = "admin@inec.com";
        if (is_null(User::where('email', $email)->first())) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => $email,
            ]);
        }

        $this->call([
            PartySeeder::class
        ]);
    }
}
