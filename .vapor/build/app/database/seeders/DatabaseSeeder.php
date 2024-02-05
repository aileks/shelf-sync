<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $users = User::factory()->count(10)->create();

        // For each user, create some books
        $users->each(function ($user) {
            Book::factory()->count(5)->create(['user_id' => $user->id]);
        });

    }
}
