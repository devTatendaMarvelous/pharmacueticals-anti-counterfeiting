<?php

use App\Models\Cart;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

function cartItems()
{
    if (Auth::check()) {
        $items = Cart::join('cart_items', 'cart_items.cart_id', '=', 'carts.id')->where('carts.cart_status', 'Pending')->where('carts.client_id', Auth::user()->id)->get()->count();
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
        return Crypt::decrypt(  auth()->user()->agent->blockchain_private_key);
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
