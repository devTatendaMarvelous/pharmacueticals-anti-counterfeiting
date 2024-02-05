<?php

namespace App\Jobs;

use App\Models\Sale;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SettleSalesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $cartItems = CartItem::where('is_settled', 0)->get();
        foreach ($cartItems as $item) {
            // dd($item->cart_id);
            // ->where('id', $item->product_id)


            $product = Product::join('users', 'users.id', '=', 'products.pharmacy_id')
                ->where('products.id', $item->product_id)
                ->get(['products.selling_price', 'users.id'])[0];

            $order_id = Order::where('cart_id', $item->cart_id)->first();
            $order_id = $order_id->id;

            $sale_amount = $product->selling_price * $item->quantity;
            $agent_id = $product->id;

            $sale = Sale::create([
                'order_id' => $order_id,
                'sales_amount' => $sale_amount,
                'pharmacy_id' => $agent_id
            ]);

            $item->is_settled = 1;
            $item->save();
        }
    }
}
