<?php

namespace App\Http\Controllers;

use App\Models\ClientProfile;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $profile = $request->validate([
                'client_phone' => 'required',
                'home_address' => 'required',
                'office_address' => 'required',
            ]);
            $profile['client_id'] = Auth::user()->id;

            if ($request->has('photo')) {
                $profile['photo'] = $request->file('photo')->store('profilePhotos', 'public');
            }
            ClientProfile::create($profile);
            User::find(Auth::user()->id)->update($profile);
            return redirect('home');
            Toastr::success('You profile has been created', 'Success');
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $indexid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        try {
            $profile = ClientProfile::where('client_id', Auth::user()->id)->first();
            if ($profile) {
                return view('profiles.edit')->with('profile', $profile);
            } elseif (Auth::user()->role != 'Client') {
                return view('profiles.edit')->with('profile', $profile);
            } else {
                return redirect('profiles/create');
            }
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
