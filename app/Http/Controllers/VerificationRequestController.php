<?php

namespace App\Http\Controllers;


use App\Models\Stock;
use App\Models\VerificationRequest;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationRequestController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = VerificationRequest::where('status', 'pending')->orderBy('id', 'desc')->get();
        return view('stock.verifications')->with(['requests' => $requests, 'carbon' => Carbon::class]);
    }

    public function reject(Request $request, $id)
    {
        if ($request->notes) {
            $data = $request->validate(['notes' => 'required']);
            $req = VerificationRequest::find($id);
            $data['status'] = 'reversed';
            Stock::find($req->stock_id)->update(['is_verified' => 0]);
            $req->update($data);
            Toastr::success('Request has been rejected successfully', 'success');
            return back();
        } else {
            Toastr::error('Provide reason for  rejection ', 'error');
            return back();
        }

    }

    public function approve($id)
    {
        $req = VerificationRequest::find($id);
        $data['status'] = 'approved';
        $req->update($data);
        Toastr::success('Request has been approved successfully', 'success');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        VerificationRequest::create(['stock_id' => $id]);
        Stock::find($id)->update(['is_verified' => 2]);
        Toastr::success('Verification request sent successfully', 'success');
        return redirect('stocks');
    }

    public function storeToken(Request $request, $id)
    {
        $stock= Stock::find($id);

        $stock->verification_token = $request->token;
        $stock->is_verified = 1;
        $stock->save();
        $req = VerificationRequest::where('stock_id',$id)->first();
        $data['status'] = 'verified';
        $req->update($data);

        Toastr::success('Verification was successful', 'success');
        return response()->json(['message' => 'success'], 200);
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
