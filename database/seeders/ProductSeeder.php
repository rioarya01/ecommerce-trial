<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            'Electronics',
            'Clothing',
            'Home & Garden',
            'Sports & Outdoors',
            'Books',
        ])->map(function (string $name) {
            return ProductCategory::firstOrCreate([
                'slug' => Str::slug($name),
            ], [
                'name' => $name,
            ]);
        });

        $productNamesByCategory = [
            'Electronics' => [
                'Smartphone Ultra',
                'Wireless Noise-Cancelling Headphones',
                'Bluetooth Speaker',
                '4K Smart TV',
                'Gaming Laptop',
                'Portable Power Bank',
                'Smartwatch Pro',
                'Wireless Keyboard & Mouse',
                'Action Camera',
                'Home Wi-Fi Router',
            ],
            'Clothing' => [
                'Classic Denim Jacket',
                'Basic Crewneck T-Shirt',
                'Slim Fit Jeans',
                'Athletic Running Shorts',
                'Comfort Hoodie',
                'Leather Wallet',
                'Casual Sneakers',
                'Summer Linen Shirt',
                'Wool Winter Scarf',
                'Rainproof Jacket',
            ],
            'Home & Garden' => [
                'Ceramic Dinner Set',
                'Indoor Plant Pot',
                'Soft Throw Blanket',
                'LED Desk Lamp',
                'Aromatherapy Diffuser',
                'Stainless Steel Knife Set',
                'Memory Foam Pillow',
                'Wall Art Frame',
                'Electric Kettle',
                'Cordless Vacuum Cleaner',
            ],
            'Sports & Outdoors' => [
                'Yoga Mat',
                'Hiking Backpack',
                'Stainless Water Bottle',
                'Trail Running Shoes',
                'Camping Tent',
                'Fitness Resistance Bands',
                'Cycling Helmet',
                'Portable Grill',
                'Golf Practice Set',
                'Workout Gloves',
            ],
            'Books' => [
                'Modern Web Development Guide',
                'Healthy Cooking Recipes',
                'Self-Improvement Journal',
                'Travel Photography Handbook',
                'Classic Literature Collection',
                'Beginner Coding Tutorials',
                'Business Strategy Playbook',
                'Children Storybook Set',
                'History of Technology',
                'Creative Writing Workbook',
            ],
        ];

        foreach ($productNamesByCategory as $categoryName => $names) {
            $category = $categories->first(fn ($c) => $c->name === $categoryName);

            foreach ($names as $name) {
                Product::factory()->create([
                    'name' => $name,
                    'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 9999),
                    'product_category_id' => $category->id,
                ]);
            }
        }
    }
}
