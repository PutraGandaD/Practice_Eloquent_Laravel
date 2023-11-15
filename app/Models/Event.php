<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'events';

    protected $fillable = [
        'event_name',
        'venue_id'
    ];

    public function tickets()
    {
        return $this->belongsToMany(TierTicket::class, 'event_ticket', 'event_id', 'ticket_id')->withPivot('buyer_name');
    }

    public function venues() {
        return $this->belongsTo(Venue::class, 'venue_id');
    }
}
