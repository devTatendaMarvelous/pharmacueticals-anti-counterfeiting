<?php

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ClientProfile;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use App\Wrappers\MailWrapper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

function cartItems()
{
    if (Auth::check()) {
        $items = Cart::join('cart_items', 'cart_items.cart_id', '=', 'carts.id')
            ->where('carts.cart_status', 'Pending')
            ->where('carts.client_id', Auth::user()->id)->get()->count();
        return $items;
    } else {
        return 0;
    }
}
function notifications()
{
    $items = Notification::where('is_published', 1)->get();
    return $items;
}
function address(){
 return Crypt::decrypt( auth()->user()->agent->blockchain_address);
}
function privateKey(){
    if (auth()->check()&&auth()->user()->type=='Agent'){
        return auth()->user()->agent->blockchain_private_key;
    }else{
        return '';
    }
}
function contractAddress(){
    $path=base_path().'\verificationContract\contractsData\VerifyProduct-address.json';
    return json_encode(json_decode(file_get_contents($path),false));
}
function contractABI(){
    $path=base_path().'\verificationContract\contractsData\VerifyProduct.json';
   return json_encode(json_decode(file_get_contents($path),true));
}
function getProduct($id){
    return json_encode(json_decode(Product::find($id),true));
}

function settleSales()
{
    $cartItems = CartItem::where('is_settled', 0)->get();
    foreach ($cartItems as $item) {

        $product = Stock::where('stocks.id', $item->stock_id)->first();


        $order = Order::where('cart_id', $item->cart_id)->first();

        $order_id = $order->id;

        $sale_amount = $product->selling_price * $item->quantity;
        $agent_id = $product->pharmacy->id;

        $sale = Sale::create([
            'order_id' => $order_id,
            'sales_amount' => $sale_amount,
            'pharmacy_id' => $agent_id
        ]);

        $item->is_settled = 1;
        $item->save();
    }
//    return true;
}

function sentTransactionEmail($data)
{
    MailWrapper::transactionSuccess($data['email'], [
        'number' => $data['number'],
        'amount' => $data['order_amount'],
        'balance' => $data['balance'],
    ]);
}

function sendOrderEmail( $user  ,$order ){

    $cartId = Order::where('order_number', $order)->first()->cart_id;

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


    $address = ClientProfile::where('client_id', $user->id)->first()->home;
    MailWrapper::emailNotify($user->email, [
        'address' => $address,
        'products' => $items,
        'order_number' => $order,
    ]);

}
