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
        return $this->belongsTo(City::class);

    }
    public function organizer(){
        return $this->belongsTo(Organizer::class);
    }

    public function inventory(){
        return $this->hasMany(TicketInventory::class);
    }
    public function ticket_purchase(){
        return $this->hasMany(TicketPurchase::class);
    }
}
