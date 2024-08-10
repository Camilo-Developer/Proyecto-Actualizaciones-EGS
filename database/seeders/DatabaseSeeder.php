<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Organizations\OrganizationsSeeder;
use Database\Seeders\Products\ProductsSeeder;
use Database\Seeders\Proyects\ProyectsSeeder;
use Database\Seeders\Roles\RolesSeeder;
use Database\Seeders\States\StatesSeeder;
use Database\Seeders\Users\UsersSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(StatesSeeder::class);
        $this->call(OrganizationsSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ProyectsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
