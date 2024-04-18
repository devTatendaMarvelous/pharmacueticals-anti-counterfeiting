<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\Order;
use App\Models\ClientProfile;
use App\Wrappers\MailWrapper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class OrderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $order;
    public $user;
    public $tries = 5;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

            $cartId = Order::where('order_number', $this->order)->first()->cart_id;

            $items =  Cart::join('cart_items', 'cart_items.cart_id', '=', 'carts.id')
                ->join('stocks', 'stocks.id', '=', 'cart_items.stock_id')
                ->join('products', 'products.id', '=', 'stocks.product_id')
                ->where('carts.id', $cartId)
                ->get([
                    'carts.id',
                    'products.product_name',
                    'stocks.selling_price',
                    'products.product_photo',
                    'cart_items.quantity',
                ]);


//
//                Cart::join('cart_items', 'cart_items.cart_id', '=', 'carts.id')
//                ->join('products', 'products.id', '=', 'cart_items.product_id')
//                ->where('carts.id', $cartId)
//                ->get([
//                    'carts.id',
//                    'products.product_name',
//                    'products.selling_price',
//                    'products.product_photo',
//                    'cart_items.quantity',
//                ]);

            $address = ClientProfile::where('client_id', $this->user->id)->first()->home;
            MailWrapper::emailNotify($this->user->email, [
                'address' => $address,
                'products' => $items,
                'order_number' => $this->order,
            ]);



    }
}
