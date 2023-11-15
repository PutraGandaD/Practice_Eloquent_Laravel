@extends('layout.main')
@section('title')
    Events
@endsection

@section('content')
    <h1>Events Page</h1>

    <p>Event count : {{ $eventCount }}</p>
    <p>Venue count : {{ $venueData }}</p>
    <p>Ticket Buyer count : {{ $buyerCount }}</p>
    <p>Ticket Buyer count (including multiple) : {{ $buyerCountAll }}</p>

    <div class="mb-3">
        <a href="{{ route('events.create') }}">
            <button type="button" class="btn btn-success">Add Event Data</button>
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Event Venue</th>
                <th>Ticket Buyer Name</th>
                <th>Ticket Tier</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventData as $item)
                <tr>
                    <td>{{ $item->event_name }}</td>
                    <td>{{ $item->venues->venue_name }}</td>
                    <td>
                        @foreach ($item->tickets as $ticketholder)
                            {{ $ticketholder->pivot->buyer_name }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($item->tickets as $ticketholder)
                            {{ $ticketholder->tier_name }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
