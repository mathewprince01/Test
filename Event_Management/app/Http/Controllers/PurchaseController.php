<?php

namespace App\Http\Controllers;

use App\Events\TicketPurchaseEvent;
use App\Http\Controllers\Controller;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\TicketInventory;
use App\Models\TicketPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{


    public function index(){
        $purchases = TicketPurchase::with(['events', 'attendee'])->get();
        return view('purchase.list', compact('purchases'));
    }
    public function create(){
        $events = Event::with('inventory')->get();
        return view('purchase.create',compact('events'));
    }
    public function store(Request $request){
       //  dd("STORE HIT", Auth::user()->role);
        $user = Auth::user();
        $attendee = null;
        if($user->role == 'Attendee'){
            $attendee = Attendee::where('user_id',$user->id)->first();
        }
        if(!$attendee){
    return back()->with('error', 'Attendee not found or you are not an attendee.');
}
        $validData = $request->validate([
            'event_id' => 'required',
            'ticket_type' => 'required',
            'quantity' => 'required'
        ]);
        $inventory = TicketInventory::find($validData['ticket_type']);
        $ticket_type = $inventory->ticket_type_name;

        $total_price = $validData['quantity'] * $inventory->price;
        // dd([
        //     'attendee_id' => $attendee->id,
        //     'event_id' => $validData['event_id'],
        //     'ticket_type' => $ticket_type,
        //     'quantity' => $validData['quantity'],
        //     'total_price' => $total_price
        // ]);


        $purchase = TicketPurchase::create([
            'attendee_id' => $attendee->id,
            'event_id' => $validData['event_id'],
            'ticket_type' => $ticket_type,
            'quantity' => $validData['quantity'],
            'total_price' => $total_price

        ]);

        $inventory->available_quantity -= $validData['quantity'];
        $inventory->save();
        event(new TicketPurchaseEvent($purchase));
        return redirect()->route('purchaseIndex')->with('success', 'Ticket Purchased Successfully!');
    }


    public function getTicketType(Request $request, TicketInventory $inventory){
        $inventories = TicketInventory::where('event_id', $request->event_id)->get();
        $options = "<option value=''>--select--</option>";

        foreach($inventories as $inventory){
            $selected = ($request->ticket_type_id == $inventory->id) ? 'selected' : '';
            $options .= "<option value='{$inventory->id}' {$selected}>{$inventory->ticket_type_name}</option>";
        }
        return $options;
    }
    public function getQuantity(Request $request){
        $inventory = TicketInventory::where('id', $request->ticket_id)->first();
        $quantity = "<div> Available Tickets: {$inventory->available_quantity}</div>";
        return response()->json(['quantity' => $quantity , 'max' => $inventory->available_quantity]);

    }
}
