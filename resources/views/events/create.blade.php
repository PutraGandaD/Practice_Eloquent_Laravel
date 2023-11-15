@extends('layout.main')
@section('title')
    Add Events
@endsection

@section('content')
    <h1>Add Events</h1>

    <form class="forms-add" action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="event_name" class="form-label">Event Name</label>
          <input type="text" class="form-control" name="event_name">
        </div>

        <div class="mb-3">
            <label for="venue_id" class="form-label">Venue</label>
            <select class="form-control" name="venue_id">
                <option value="" disabled selected hidden>Select Venue...</option>
                @foreach ($venue as $venue_item)
                    <option value="{{ $venue_item->id }}">{{ $venue_item->venue_name }}</option>
                @endforeach
            </select>
        </div>

        <label for="" class="form-label">Ticket Buyer</label>
        <table class="table table-bordered" id="tableTicketBuyer">
            <thead>
                <th>Ticket Buyer Name</th>
                <th>Ticket Tier Name</th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" class="form-control" name="inputs[0][buyer_name]">
                    </td>
                    <td>
                        <select class="form-control" name="inputs[0][ticket_id]">
                            <option value="" disabled selected hidden>Select Ticket Tier...</option>
                            <?php
                                $data = array();
                                foreach( $ticketTier as $ticket ) {
                                    $data[] = $ticket->tier_name;
                                }
                            ?>
                            @foreach ($ticketTier as $ticketTier_item)
                                <option value="{{ $ticketTier_item->id }}">{{ $ticketTier_item->tier_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-center" >
                        <button type="button" class="btn btn-info" id="addBuyerData">Add More Buyer</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Add Data</button>
    </form>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    var i = 0;

    $('#addBuyerData').on('click', function() {
        ++i;

        // Get the options for ticket tiers from the server
        var ticketOptions = {!! json_encode($ticketTier) !!};

        // Add row
        var newRow = '<tr>\n\
                        <td>\n\
                            <input type="text" class="form-control" name="inputs['+i+'][buyer_name]">\n\
                        </td>\n\
                        <td>\n\
                            <select class="form-control" name="inputs['+i+'][ticket_id]">\n\
                                <option value="" disabled selected hidden>Select Ticket Tier...</option>';

        // Add ticket options to the dropdown
        ticketOptions.forEach(function(ticketTier_item) {
            newRow += '<option value="'+ticketTier_item.id+'">'+ticketTier_item.tier_name+'</option>';
        });

        newRow += '</select>\n\
                    </td>\n\
                    <td class="text-center" >\n\
                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove Buyer</button>\n\
                    </td>\n\
                </tr>';

        $('#tableTicketBuyer tbody').append(newRow);
    });

    function removeRow(button) {
        // Remove the entire row
        $(button).closest('tr').remove();
    }
</script>
@endsection

