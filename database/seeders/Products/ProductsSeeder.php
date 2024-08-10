<?php

namespace Database\Seeders\Products;

use App\Models\Product\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Gestión Jurídica',
            'version' => 'Academica',
        ]);
        Product::create([
            'name' => 'Gestión Jurídica',
            'version' => 'Professional',
        ]);
    }
}
