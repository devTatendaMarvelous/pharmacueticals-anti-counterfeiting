<?php

namespace App\Http\Controllers;

use App\Business\Services\ClientWrapper;
use App\Jobs\FailedTransactionJob;
use App\Jobs\TransactionJob;
use App\Models\Card;
use App\Models\ClientProfile;
use App\Models\Product;
use App\Wrappers\MailWrapper;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Jobs\OrderMailJob;
use App\Jobs\SettleSalesJob;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            if (Auth::user()->type === 'Client') {
                $orders = Order::join('carts', 'carts.id', '=', 'orders.cart_id')
                    ->join('users', 'users.id', '=', 'carts.client_id')
                    ->where('carts.client_id', Auth::user()->id)
                    ->select(['orders.*','users.name'])
                    ->get();
            } else if (Auth::user()->type === 'Agent') {

                $orders = Order::join('sales', 'sales.order_id', '=', 'orders.id')
                    ->join('carts', 'carts.id', '=', 'orders.cart_id')
                    ->join('users', 'users.id', '=', 'carts.client_id')
                    ->where('sales.pharmacy_id', Auth::user()->id)
                    ->get(['users.name', 'sales.sales_amount', 'orders.*']);
                $groupedOrders = [];

                foreach ($orders as $order) {
                    $orderId = $order->order_number;
                    if (!array_key_exists($orderId, $groupedOrders)) {
                        $groupedOrders[$orderId] = [
                            'id' => $order->id,
                            'name' => $order->name,
                            'order_number' => $order->order_number,
                            'delivery_date' => $order->delivery_date,
                            'currency' => $order->currency,
                            'payment_method' => $order->payment_method,
                            'status' => $order->status,
                            'order_amount' => 0,
                        ];
                    }
                    $amount = $order->sales_amount;

                    $groupedOrders[$orderId]['order_amount'] += $amount;
                }

                $orders = [];
                foreach ($groupedOrders as $key => $value) {
                    $object = (object) $value;
                    $object->id = $key;
                    $orders[] = $object;
                }
            } else {
                $orders = Order::join('carts', 'carts.id', '=', 'orders.cart_id')
                    ->join('users', 'users.id', '=', 'carts.client_id')->select(['orders.*','users.name'])
                    ->get();
            }

            return view('orders.index')->with('orders', $orders);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    public function store(Request $request, $id)
    {
        try {

            $card=[];
            $order = $request->validate([
                "delivery" => "required",
                "is_future" => "required",
                "order_amount" => "required",
                "payment_method" => "required",
                "currency" => "required",
            ]);
            DB::beginTransaction();
            if($request->payment_method=='Master') {
                $card = Card::where('name', $request->name)->where('expiry_date', $request->expiry)->where('cvv', $request->cvv)->first();

                if ($card && substr($card->number, -4) == substr(intval($request->number), -4)) {

                    if ($card->balance < $order["order_amount"]) {
                        FailedTransactionJob::dispatch(Auth::user(), substr($card->number, -4), date('D M Y'), date('h:i:s'));
                        Toastr::error('The card used has insufficient funds ', 'error');
                        return back();
                    } else {
                        $order['account_number'] = strval($request->number) . "," . $request->expiry . "," . $request->cvv;
                        $order['order_number'] = 'OMS-O' . random_int(100, 10000);
                        $card->balance-=$order["order_amount"];
                        $card->save();
                    }

                } else {
                    Toastr::error('Card card details  not found', 'error');
                    return back();
                }
            }else{
                Toastr::error('Choose Payment method', 'error');
                return back();
            }
                    $order['cart_id'] = $id;
                    $order['status'] = 'Paid';
                    $order['delivery_date'] = Carbon::parse(now())->format('Y-m-d');
                    $order['currency'] = 'USD';

                    $order = Order::create($order);

                    if ($order) {
                        $cart = Cart::find($id);
                        $cart->cart_status = 'Ordered';
                        $cart->save();
                    }

            settleSales();

                $transaction=[
                    'number'=>substr($card->number,-4),
                    'order_amount'=>$order->order_amount,
                    'balance'=>$card->balance,
                    'email'=>Auth::user()->email
                ];

            sentTransactionEmail($transaction);

            sendOrderEmail(Auth::user(), $order->order_number);


                DB::commit();
                    Toastr::success('Order  successfully placed.  Thank you for shopping with us👏', 'success');

                    return redirect('orders');

        } catch (\Exception $e) {
            return $e->getMessage();
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    /**
     *
     * Display the specified resource.
     */
    public function show( $id)
    {
        $order=Order::where('id',$id)->first();
        $items = Cart::join('cart_items', 'cart_items.cart_id', '=', 'carts.id')
            ->join('stocks', 'stocks.id', '=', 'cart_items.stock_id')
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('agents', 'agents.id', '=', 'stocks.pharmacy_id')
            ->join('users', 'users.id', '=', 'agents.user_id')
            ->where('cart_items.cart_id',$order->cart_id)
            ->get([
                'carts.id',
                'products.product_name',
                'stocks.selling_price',
                'products.product_photo',
                'cart_items.quantity',
                'users.name',
            ]);
        return view('orders.show')->with(['products'=>$items,'carbon'=>Carbon::class,'order'=>$order]);
    }
}
