<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        User::factory()->create([
            'email' => 'a@a.com',
            'password' => '$2a$12$kk/1p/TlzK3D.0ybVGX5xOhxSWE0JWOfWMixSQgOiIQ85p/VtsXO6'
        ]);
    }
}
