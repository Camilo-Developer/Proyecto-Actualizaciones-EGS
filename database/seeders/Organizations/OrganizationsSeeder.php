<?php

namespace Database\Seeders\Organizations;

use App\Models\Organization\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::create([
            'name'=>'Areandina Bogotá',
            'subdomain'=>'areandinabogota',
            'route'=>'mnt/areandina',
            'server'=>'253',
            'connection_db'=>'Conexion a la db',
        ]);
    }
}
