<?php

namespace Database\Seeders\Users;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'Admin',
            'lastname'=> 'Admin',
            'loginname'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password'=> Hash::make('123'),
            'state_id'=> 1,
        ])->assignRole('Admin');
    }
}
