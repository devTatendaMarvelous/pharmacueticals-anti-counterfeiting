<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Sale;

use App\Models\Stock;
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
            $orders = Order::where('status', 'Ordered')->orWhere('status', 'Paid')->get();

            $clients = User::where('type', 'Client')->get();
            $sales = null;
$pharmacies =[];
            if (Auth::user()->type == 'Manufacturer') {
                $sales = Sale::where('pharmacy_id', Auth::user()->id)->get();
                $pharmacies = Agent::all()->count();
                $products = Product::where('manufacturer_id', Auth::user()->manufacturer->id)->where('is_active', 1)->get();


            } elseif (Auth::user()->type == 'Agent') {

                $sales = Sale::where('pharmacy_id', Auth::user()->agent->id)->get();
                $products = Stock::where('pharmacy_id', Auth::user()->agent->id)->where('is_published', 1)->get();
                $orders = Order::whereHas('cart', function ($query) {
                    $query->whereHas('items', function ($query) {
                        $query->whereHas('stock', function ($query) {
                            $query->where('pharmacy_id', Auth::user()->agent->id);
                        });
                    });
                })->orderBy('id', 'desc')->take(6)->get();

            } else {
                $sales = Sale::all();
                $products = Stock::where('is_published', 1)->get();
            }



            $revenue = 0.0;

            foreach ($sales as $sale) {
                $revenue += $sale->sales_amount;
            }

            return view('home')
                ->with('orders', $orders->count())
                ->with('pharmacies', $pharmacies)
                ->with('products', $products->count())
                ->with('clients', $clients->count())
                ->with('products', $products->count())
                ->with('order_list', $orders->take(6))
                ->with('revenue', $revenue);
        } catch (\Exception $e) {

            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }
}
