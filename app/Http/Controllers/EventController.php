<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TierTicket;
use App\Models\Venue;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $venue = Venue::all();
        $ticketTier = TierTicket::all();
        return view('events.create')->with('venue', $venue)->with('ticketTier', $ticketTier);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'event_name' => 'required'
        ]);

        $event = Event::create([
            'event_name' => $validate['event_name']
        ]);

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
