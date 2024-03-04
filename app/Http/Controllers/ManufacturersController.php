<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class ManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manufacturers.index')->with('manufacturers', Manufacturer::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $agent = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'tel' => 'required',
                'address' => 'required',
                'photo' => 'required'
            ]);

            $agent['type'] = 'Manufacturer';
            $agent['photo'] = $request->file('photo')->store('ManufacturerLogos', 'public');
            $agent['licence'] = $request->file('photo')->store('ManufacturerLicences', 'public');
            $agent['password'] = Hash::make('password');
            $user = User::create($agent);
            $agent['user_id'] = $user->id;
            Manufacturer::create($agent);
            Toastr::success('Manufacturer Account created successfully', 'success');
            DB::commit();
            return redirect('manufacturers');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
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
