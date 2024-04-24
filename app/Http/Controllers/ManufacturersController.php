<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Validator;

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
            $validator = $this->validateData($request);
            if ($validator->status) {
            DB::beginTransaction();

        $manufacturer = $request->all();

                if (Agent::where('tel',$manufacturer['tel'])->orWhere('cell', $manufacturer['tel'])->exists()){
                    Toastr::error('Phone number already in use', 'Phone number in use');
                    return redirect()->back();
                }
                if (strlen($manufacturer['tel']) < 9){
                    Toastr::error('Phone number cannot be less than 9 digits', 'Phone number too short');
                    return redirect()->back();
                }elseif (strlen($manufacturer['tel']) > 10){
                    Toastr::error('Phone number cannot be more than 10 digits', 'Phone number too long');
                    return redirect()->back();
                }
            $manufacturer['type'] = 'Manufacturer';
            $manufacturer['photo'] = $request->file('photo')->store('ManufacturerLogos', 'public');
            $manufacturer['licence'] = $request->file('photo')->store('ManufacturerLicences', 'public');
            $manufacturer['password'] = Hash::make('password');
            $user = User::create($manufacturer);
            $manufacturer['user_id'] = $user->id;
            Manufacturer::create($manufacturer);
            Toastr::success('Manufacturer Account created successfully', 'success');
            DB::commit();

            return redirect('manufacturers');

            } else {
                return redirect()->back()->withErrors($validator->errors)->withInput();
            }
        } catch (Exception $e) {
            DB::rollBack();

            Toastr::error($e->getMessage(), 'error');
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
        return view('manufacturers.edit')->with('manufacturer',Manufacturer::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

                DB::beginTransaction();
                $manufacturer = $request->all();
               $man= Manufacturer::find($id);
            $man->update($manufacturer);
                $man->user->update($manufacturer);
                Toastr::success('Manufacturer Account updated successfully', 'success');
                DB::commit();

                return redirect('manufacturers');


        } catch (Exception $e) {
            DB::rollBack();

            Toastr::error($e->getMessage(), 'error');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $man=Manufacturer::find($id);
        $man->delete();
        $man->user->delete();

        Toastr::success('Manufacturer Account deleted successfully', 'success');
        return redirect('manufacturers');
    }

    function validateData($request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'tel' =>  ['required','unique:agents','numeric'],
            'address' => 'required',

        ];

        $customMessages = [
            'tel.numeric' => 'phone number can only contain numeric characters',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            $validation = json_decode(json_encode(['status' => false, 'errors' => $validator->errors()]), false);
        } else {
            $validation = json_decode(json_encode(['status' => true]), false);
        }
        return $validation;
    }

}
