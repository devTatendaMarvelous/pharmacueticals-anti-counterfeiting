<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    function index()
    {
        return view('notifications.index')
            ->with('notifications', Notification::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Notification::create($request->validate(
            ['notification' => 'required']
        ));
        return redirect('notifications');
    }

    function publish($id)
    {
        $notification = Notification::find($id);
        $notification->is_published = 1;
        $notification->save();
        return redirect('notifications');
    }

    function unpublish($id)
    {
        $notification = Notification::find($id);
        $notification->is_published = 0;
        $notification->save();
        return redirect('notifications');
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
