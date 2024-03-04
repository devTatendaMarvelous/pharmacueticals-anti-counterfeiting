<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Stock;
use App\Models\User;
use App\Models\Branch;
use App\Models\Product;
use App\Models\AgentType;
use App\Models\Notification;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    public function index()
    {
        try {

            $agents = User::join('agents', 'agents.user_id', '=', 'users.id')->get(['users.name', 'users.email', 'users.photo', 'agents.*']);
            return view('frontend.index')
                ->with('agents', $agents)
                ->with('cartItems', cartItems())
                ->with('notifications', notifications());
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    public function agentsFilter($id)
    {
        try {
            $agents = User::join('agents', 'agents.user_id', '=', 'users.id')
                ->where('agents.type_id', $id)->get(['users.name', 'users.email', 'users.photo', 'agent_types.type_name', 'agents.*']);
            $types = AgentType::all();
            return view('frontend.index')
                ->with('types', $types)
                ->with('agents', $agents)
                ->with('cartItems', $this->cartItems())
                ->with('notifications', $this->notifications());
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    function agent($id)
    {
        try {
            $categories = Category::all();

            $products = Stock::where('pharmacy_id',$id)
                ->where('is_published', 1)
                ->get();
            return view('frontend.branches')
                ->with('categories', $categories)
                ->with('products', $products)
                ->with('cartItems', cartItems())
                ->with('notifications', notifications());
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    function search(Request $request)
    {
        try {
            $categories = Category::all();
            $products = stock::join('products', 'products.id', '=', 'stocks.product_id')
                ->where('products.product_name', 'like', '%' . $request->search . '%')
                ->where('stocks.is_published', 1)
                ->get(['stocks.*']);
            return view('frontend.branches')
                ->with('categories', $categories)
                ->with('products', $products)
                ->with('cartItems', cartItems())
                ->with('notifications', notifications());
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }


    function branch($id)
    {
        try {
            $categories = Category::all();
            $category=Category::where('id',$id)->with('stocks',function ($query){
                $query->where('is_published',1);
            })->first();

            return view('frontend.branches')
                ->with('categories', $categories)
                ->with('products', $category->stocks)
                ->with('cartItems', cartItems())
                ->with('notifications', notifications());

        } catch (\Exception $e) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }

    }

    function check()
    {
        return view('frontend.check-verification')->with('cartItems', cartItems())
            ->with('notifications', notifications());

    }
}
