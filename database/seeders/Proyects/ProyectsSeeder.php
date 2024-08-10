<?php

namespace Database\Seeders\Proyects;

use App\Models\Proyect\Proyect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProyectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proyect::create([
            'name' => 'Atención al usuario',
            'product_id' => 1,
        ]);
        Proyect::create([
            'name' => 'Conciliamos',
            'product_id' => 1,
        ]);
        Proyect::create([
            'name' => 'Administrador',
            'product_id' => 1,
        ]);

        Proyect::create([
            'name' => 'Atención al usuario',
            'product_id' => 2,
        ]);
        Proyect::create([
            'name' => 'Administrador',
            'product_id' => 2,
        ]);
    }
    
}
