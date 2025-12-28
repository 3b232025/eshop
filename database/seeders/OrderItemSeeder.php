<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::pluck('id')->toArray();
        $orders = Order::all();

        foreach ($orders as $order) {
            $picked = collect($productIds)->shuffle()->take(3);

            foreach ($picked as $pid) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $pid,
                    'quantity' => rand(1, 5),
                ]);
            }
        }
    }
}
