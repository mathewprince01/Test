<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function city(){
        return $this->belongTo(City::class);

    }
    public function organizer(){
        return $this->belongsTo(Organizer::class);
    }

    public function ticket_inventory(){
        return $this->hasmany(TicketInventory::class);
    }
    public function ticket_purchase(){
        return $this->hasmany(TicketPurchase::class);
    }
}
