<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $this->seedUsers();
        $this->seedMovies();
    }

    private function seedUsers(): void
    {
        User::query()->delete();
        User::factory()->create([
            'name' => 'Mara',
            'email' => 'maragambero@example.com',
            'password' => bcrypt('maragambero'),
        ]);

        User::factory()->create([
            'name' => 'Mara Prueba 2',
            'email' => 'prueba2@example.com',
            'password' => bcrypt('prueba2'),
        ]);
    }

    private function seedMovies(): void{
        $movieSeeder = new MovieSeeder();
        $movieSeeder->run();
    }
}
