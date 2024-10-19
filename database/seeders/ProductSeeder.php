<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

final class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; ++$i)
        {
            Product::create([
                'name'  => 'Товар '.$i,
                'price' => 10.00,
            ]);
        }
    }
}
