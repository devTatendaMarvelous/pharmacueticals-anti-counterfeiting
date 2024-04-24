<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use App\Jobs\UpdateStockJob;
use App\Models\Notification;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\ClientProfile;
use App\Wrappers\MailWrapper;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{

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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $items = Cart::join('cart_items', 'cart_items.cart_id', '=', 'carts.id')
                ->join('stocks', 'stocks.id', '=', 'cart_items.stock_id')
                ->join('products', 'products.id', '=', 'stocks.product_id')
                ->join('agents', 'agents.id', '=', 'stocks.pharmacy_id')
                ->join('users', 'users.id', '=', 'agents.user_id')
                ->where('carts.cart_status', 'Pending')
                ->where('carts.client_id', Auth::user()->id)
                ->get([
                    'carts_id' => 'carts.id',
                    'users.name',
                    'products.product_name',
                    'stocks.selling_price',
                    'products.product_photo',
                    'cart_items.quantity',
                    'cart_items.id',
                ]);
            $cart_id = $items->first();
            if ($cart_id) {
                $cart_id = $cart_id->id;
            } else {
                $cart_id = '';
            }
            $total = 0;

            foreach ($items as $item) {
                $total += ($item->selling_price * $item->quantity);
            }

            $cartItems = Cart::join('cart_items', 'cart_items.cart_id', '=', 'carts.id')->where('carts.cart_status', 'Pending')->where('carts.client_id', Auth::user()->id)->get()->count();

            return view('carts.index')
                ->with('items', $items)
                ->with('notifications', $this->notifications())
                ->with('cartItems', $cartItems)
                ->with('total', $total)
                ->with('cart_id', $cart_id);
        } catch (\Exception $exception) {

            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkout($id, $price)
    {
        try {
            $profile = ClientProfile::where('client_id', Auth::user()->id)->first();
            $items = Cart::join('cart_items', 'cart_items.cart_id', '=', 'carts.id')
                ->join('stocks', 'stocks.id', '=', 'cart_items.stock_id')
                 ->join('products', 'products.id', '=', 'stocks.product_id')
                ->where('carts.cart_status', 'Pending')
                ->where('carts.client_id', Auth::user()->id)
                ->get([
                    'carts.id',
                    'products.product_name',
                    'stocks.selling_price',
                    'products.product_photo',
                    'cart_items.quantity',
                ]);
            $cartId = $items->first()->id;

            return view('carts.checkout')
                ->with('notifications', $this->notifications())
                ->with('cartItems', $this->cartItems())
                ->with('products', $items)
                ->with('profile', $profile)
                ->with('cartId', $cartId)
                ->with('price', $price);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        try {
            $product = Stock::find($id);
            if ($request->quantity > $product->quantity) {
                Toastr::error('Your order quantity exceeds our current stock level', 'error');
                return back();
            } else {

                $cart = Cart::where('client_id', Auth::user()->id)->where('cart_status', 'Pending')->first();

                if ($cart) {
                    $item = CartItem::where('stock_id', $id)->where('cart_id', $cart->id)->first();

                    if ($item) {
                        $item->quantity = $item->quantity + $request->quantity;

                        $item->save();
                    } else {
                        CartItem::create([
                            'cart_id' => $cart->id,
                            'stock_id' => $id,
                            'quantity' => $request->quantity,
                        ]);
                    }
                } else {
                    $cart = Cart::create([
                        'client_id' => Auth::user()->id,
                    ]);
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'stock_id' => $id,
                        'quantity' => $request->quantity,
                    ]);
                }

                $product->quantity =  $product->quantity - $request->quantity;

                $product->save();



                if ($product->quantity > ($product->minimun_order * 1.25)) {

                    $product->product_status = 'Good';
                } elseif ($product->quantity < $product->minimun_order) {

                    $product->product_status = 'Low';
                } else {

                    $product->product_status = 'Reorder';
                }
                $product->save();

                Toastr::success('Item added', 'success');
                return back();
            }
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function remove( $id)
    {
        try {
            $item=CartItem::find($id);

            $item->delete();
            Toastr::success('Item removed successfully ', 'success');
            return back();
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }


}
