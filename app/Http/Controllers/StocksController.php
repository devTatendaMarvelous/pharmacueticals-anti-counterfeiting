<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock=Stock::where('pharmacy_id',auth()->user()->agent->id)->get();
        return view('stock.index')->with('stock',$stock);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    function publish($id)
    {
        $product = Stock::find($id);
        $product->is_published = 1;
        $product->save();
        return redirect('stocks');
    }
    function unpublish($id)
    {
        $product = Stock::find($id);
        $product->is_published = 0;
        $product->save();
        return redirect('stocks');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $stock=$request->validate([
            "product_id" => "required",
          "buying_price" => "required",
          "selling_price" => "required",
          "quantity" => "required",
          "minimun_order" => "required",
          "product_description" => "required",
        ]);
        $stock['pharmacy_id']=auth()->user()->agent->id;

        Stock::create($stock);
        Toastr::success('Stock captured successfully', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
