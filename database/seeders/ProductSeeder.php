<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            "name" => "Product 1",
            "description" => "Description for Product 1",
            "price" => 12000,
            "stock" => 10,
            "status" => 1,
            "category_id" => 1,
        ]);
        Product::create([
            "name" => "Product 2",
            "description" => "Description for Product 2",
            "price" => 120000,
            "stock" => 5,
            "status" => 1,
            "category_id" => 1,
        ]);
        Product::create([
            "name" => "Product 3",
            "description" => "Description for Product 3",
            "price" => 200000,
            "stock" => 0,
            "status" => 1,
            "category_id" => 2,
        ]);
        Product::create([
            "name" => "Product 4",
            "description" => "Description for Product 4",
            "price" => 41000,
            "stock" => 15,
            "status" => 1,
            "category_id" => 2,
        ]);
        Product::create([
            "name" => "Product 5",
            "description" => "Description for Product 5",
            "price" => 61000,
            "stock" => 1,
            "status" => 1,
            "category_id" => 2,
        ]);
        Product::create([
            "name" => "Product 6",
            "description" => "Description for Product 6",
            "price" => 26000,
            "stock" => 3,
            "status" => 1,
            "category_id" => 2,
        ]);
        Product::create([
            "name" => "Product 7",
            "description" => "Description for Product 7",
            "price" => 4000,
            "stock" => 2,
            "status" => 1,
            "category_id" => 4,
        ]);
    }
}
