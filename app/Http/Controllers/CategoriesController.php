<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = User::join('categories', 'categories.category_creator', '=', 'users.id')->get();
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $category = $request->validate([
                "category_name" => "required",
                "category_description" => "required",

            ]);
            if ($request->has('category_icon')) {

                $category['category_icon'] = $request->file('category_icon')->store('productPhotos', 'public');
            }
            $category['category_creator'] = Auth::user()->id;
            Category::create($category);
            Toastr::success('Category Successfully added', 'success');
            return redirect('categories');
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $category = $request->validate([
                "category_name" => "required",
                "category_description" => "required",

            ]);
            // update
            if ($request->has('category_icon')) {

                $category['category_icon'] = $request->file('category_icon')->store('productPhotos', 'public');
            }

            Category::find($id)->update($category);
            Toastr::success('Category Successfully updated', 'success');
            return redirect('categories');
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
        Category::find($id)->delete();
        return redirect('categories');
    }
}
