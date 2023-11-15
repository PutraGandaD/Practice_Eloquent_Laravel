<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TierTicket;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventData = Event::all();
        $venueData = Venue::all()->count();
        $eventCount = Event::all()->count();
        $buyerCount = DB::table('event_ticket')->distinct('buyer_name')->count();
        $buyerCountAll = DB::table('event_ticket')->count();
        return view('events.index')->with('eventData', $eventData)->with('venueData', $venueData)->with('buyerCount', $buyerCount)->with('eventCount', $eventCount)->with('buyerCountAll', $buyerCountAll);
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
            'event_name' => 'required',
            'venue_id' => 'required'
        ]);

        $event = Event::create([
            'event_name' => $validate['event_name'],
            'venue_id' => $validate['venue_id']
        ]);

        $inputs = $request->input('inputs');

        // Iterate over the array and handle each set of data
        foreach ($inputs as $input) {
            // Assuming you have columns like 'buyer_name' and 'ticket_id' in the array
            $buyerName = $input['buyer_name'];
            $ticketId = $input['ticket_id'];

            // Perform actions with the data, such as attaching to the event
            $event->tickets()->attach($ticketId, ['buyer_name' => $buyerName]);
        }

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
