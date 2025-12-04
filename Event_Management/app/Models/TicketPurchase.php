<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketPurchase extends Model
{
    protected $guarded = [];
    public function attendee(){
        return $this->belongsTo(Attendee::class);
    }
    public function events(){
        return $this->belongsTo(Event::class,'event_id');
    }
      protected $fillable = [
        'attendee_id',
        'event_id',
        'ticket_type',
        'quantity',
        'total_price',
    ];
}
