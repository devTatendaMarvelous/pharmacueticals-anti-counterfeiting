<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->where('pharmacy_id', Auth::user()->id)
            ->get(['categories.category_name', 'products.*']);
        $categories=Category::all();

        return view('products.index')->with('categories', $categories)->with('products', $products);
    }

    function publish($id)
    {
        $product = Product::find($id);
        $product->is_published = 1;
        $product->save();
        return redirect('products');
    }
    function unpublish($id)
    {
        $product = Product::find($id);
        $product->is_published = 0;
        $product->save();
        return redirect('products');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $product = $request->validate([
                "product_name" => "required",
                "serial" => "required",
                "category_id" => "required",
                "buying_price" => "required",
                "selling_price" => "required",
                "quantity" => "required",
                "minimun_order" => "required",
                "product_description" => "required",
            ]);

            $product['pharmacy_id'] = auth()->user()->id;
            if ($request->has('product_photo')) {
                $product['product_photo'] = $request->file('product_photo')->store('productPhotos', 'public');
            }
            Product::create($product);
            return redirect('products');
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
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
        try {
            $product = $request->validate([
                "product_name" => "required",
                "buying_price" => "required",
                "selling_price" => "required",
                "quantity" => "required",
                "product_description" => "required",
            ]);

            if ($request->has('product_photo')) {

                $product['product_photo'] = $request->file('product_photo')->store('productPhotos', 'public');
            }

            $orig_product = Product::find($id);

            $product['quantity'] += $orig_product->quantity;

            $orig_product->update($product);
            $product = Product::find($id);
            if ($product->quantity > ($product->minimun_order * 1.25)) {

                $product->product_status = 'Good';
            } elseif ($product->quantity < $product->minimun_order) {

                $product->product_status = 'Low';
            } else {

                $product->product_status = 'Reorder';
            }
            $product->save();

            return redirect('products');
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
