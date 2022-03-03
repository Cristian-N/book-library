<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Edition;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret'),
        ]);

        User::factory(4)->create();

        Work::factory(10)
            ->has(Edition::factory()->count(5))
            ->has(Author::factory()->count(1))
            ->create();
    }
}
