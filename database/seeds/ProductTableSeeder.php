<?php

use App\Product;
use App\ProductQuantity;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductTableSeeder extends Seeder
{
    private $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 50)->create()->each(function ($product) {
            ProductQuantity::createDefaultProductQuantities($product->id, $this->faker->numberBetween(0, 500));
        });
    }
}
