<?php

namespace App\Http\Controllers;

use App\Models\Sale;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\ClientProfile;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            if (Auth::user()->type === 'Client') {
                $profile = ClientProfile::where('client_id', Auth::user()->id)->first();
                if (!$profile) {
                    return redirect('profiles/create');
                }
                return redirect('orders');
            }
            $orders = Order::where('status', 'Ordered')->get();
            $products = Product::where('is_published', 1)->get();
            $clients = User::where('type', 'Client')->get();
            $sales = null;

            if (Auth::user()->type === 'Agent') {
                $sales = Sale::where('pharmacy_id', Auth::user()->id)->get();

                $products = Product::where('pharmacy_id', Auth::user()->id)->where('is_published', 1)->get();
            } else {
                $sales = Sale::all();
            }

            $order_list = Order::orderBy('id', 'desc')->take(6)->get();

            $revenue = 0.0;

            foreach ($sales as $sale) {
                $revenue += $sale->sales_amount;
            }

            return view('home')
                ->with('orders', $orders->count())
                ->with('products', $products->count())
                ->with('clients', $clients->count())
                ->with('products', $products->count())
                ->with('order_list', $order_list)
                ->with('revenue', $revenue);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'error');
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }
}
