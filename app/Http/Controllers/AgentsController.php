<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use App\Models\AgentType;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $agents = User::join('agents', 'agents.user_id', '=', 'users.id')
                ->get(['users.name', 'users.email', 'users.photo',  'agents.*']);
            return view('agents.index')->with('agents', $agents);
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('agents.create');
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
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
                'password' => ['required', 'confirmed'],
                'tel' =>
                'required',
                'cell'
                => 'required',
                'agent_address'
                => 'required',
                'agent_description'
                => 'required',
            ]);
            if($request->has('blockchain_private_key')){
                $agent['blockchain_private_key']=Crypt::encrypt($request->blockchain_private_key);

            }
            if($request->has('blockchain_address')){
                $agent['blockchain_address']=Crypt::encrypt($request->blockchain_address);
            }

            $agent['type'] = 'Agent';
            $agent['photo'] = $request->file('photo')->store('agentLogos', 'public');
            $agent['password'] = Hash::make($agent['password']);
            $user = User::create($agent);
            $agent['user_id'] = $user->id;
            Agent::create($agent);
            Toastr::success('Pharmacy Account created successfully', 'success');
            DB::commit();
            return redirect('pharmacies');
        } catch (\Exception $e) {
            DB::rollBack();

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
        $agent = User::join('agents', 'agents.user_id', '=', 'users.id')->where('agents.id', $id)->get(['users.name', 'users.email', 'agents.*']);

        return view('agents.edit')->with('agent', $agent[0]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $agent = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'tel' =>
                'required',
                'cell'
                => 'required',
                'agent_address'
                => 'required',
                'agent_description'
                => 'required',
            ]);
            if($request->has('blockchain_private_key')){
                $agent['blockchain_private_key']=Crypt::encrypt($request->blockchain_private_key);

            }
            if($request->has('blockchain_address')){
                $agent['blockchain_address']=Crypt::encrypt($request->blockchain_address);
            }
            $agentAccount = User::where('email', $agent['email'])->get()[0];

            $agentAccount->update($agent);

            $agentDetails = Agent::where('id', $id)->get()[0];
            $agentDetails->update($agent);
            DB::commit();
            Toastr::success('Pharmacy Account updated successfully', 'success');
            return redirect('pharmacies');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
//            Toastr::error('An error occured while processing', 'error');
//            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $agent = User::join('agents', 'agents.user_id', '=', 'users.id')->where('agents.id', $id)->get(['users.name', 'users.email', 'agents.*'])[0];
            $agentAccount = User::where('email', $agent['email'])->get()[0];
            $agentAccount->delete();
            $agentDetails = Agent::where('id', $id)->get()[0];
            $agentDetails->delete();
            Toastr::success('Pharmacy deleted successfully', 'success');
            return redirect('agents');
        } catch (\Exception $exception) {
            Toastr::error('An error occured while processing', 'error');
            return back();
        }
    }
}
