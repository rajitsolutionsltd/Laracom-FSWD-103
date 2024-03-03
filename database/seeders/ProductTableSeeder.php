<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $storeQuantity = 10;
            for ($i = 1; $i <= $storeQuantity; $i++) {
                $product = new Product();
                $product->name = 'Product ' . $i;
                $product->stock_quantity = rand(20, 40);
                $product->price = rand(100, 400);
                $product->category_id = $category->id;
                $product->save();
            }
        }
    }
}
