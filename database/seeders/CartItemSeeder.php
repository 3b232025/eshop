<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::pluck('id')->toArray();
        $users = User::all();

        foreach ($users as $user) {
            $picked = collect($productIds)->shuffle()->take(3);

            foreach ($picked as $pid) {
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $pid,
                ]);
            }
        }
    }
}
