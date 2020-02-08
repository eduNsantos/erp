<?php

use App\Product;
use App\ProductQuantity;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 50)->create()->each(function ($product) {
            ProductQuantity::createDefaultProductQuantities($product->id);
        });
    }
}
