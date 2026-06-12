<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty()) {
            User::factory(5)->create();
            $users = User::all();
        }

        if ($products->isEmpty()) {
            Product::factory(25)->create();
            $products = Product::all();
        }

        for ($i = 0; $i < 50; $i++) {
            $orderDate = fake()->dateTimeBetween('-6 days', 'now');
            $orderItems = [];
            $itemsCount = fake()->numberBetween(1, 4);
            $selectedProducts = $products->random(min($itemsCount, $products->count()));

            $totalAmount = 0;

            foreach ($selectedProducts as $product) {
                $quantity = fake()->numberBetween(1, 5);
                $price = $product->price;
                $itemTotal = $quantity * $price;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ];

                $totalAmount += $itemTotal;
            }

            $order = Order::create([
                'order_number' => 'ORD-' . Str::upper(fake()->unique()->bothify('########')),
                'status' => fake()->randomElement(['pending', 'processing', 'completed', 'cancelled']),
                'shipping_address' => fake()->address(),
                'total_amount' => $totalAmount,
                'user_id' => $users->random()->id,
            ]);

            Order::where('id', $order->id)
                ->update([
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);

            foreach ($orderItems as &$item) {
                $item['order_id'] = $order->id;
            }

            OrderItem::insert($orderItems);
        }
    }
}
