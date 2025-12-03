<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Event;
use App\Models\TicketInventory;
use Illuminate\Http\Request;

use function Pest\Laravel\options;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $user = Auth::user();
        $query = Event::with('country','city','organizer','inventory','ticket_purchase');
        if($user->role == 'Organizer'){
            $organizer = Organizer::where('user_id',$user->id)->first();
            $query->where('organizer_id',$organizer->id);
        }
        $events = $query->get();
        $cities = City::pluck('name','id');
        return view('event.list',compact('events','cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id');
        $organizers = Organizer::pluck('name','id' );
        return view('event.create', compact('countries', 'organizers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'event_name' => 'required|regex:/^[A-Za-z\s]+$/|max:100',
            'event_date' => 'required|after:tomorrow',
            'event_time' => 'required',
            'venue' => 'required|regex:/^[A-Za-z\s]+$/',
            'city' => 'required',
            'country' => 'required',
            'event_type' => 'required',
            'event_banner' => 'file|image|mimes:jpg,png|max:500',
            'organizer' => 'required',
            'max_attendees' => 'required|numeric|min:1',

            'inventory' => 'required|array|min:1|max:3',
            'inventory.*.ticket_type_name' => 'required|alpha_num',
            'inventory.*.price' => 'required|numeric|min:0',
            'inventory.*.max_quantity' => 'required|numeric|min:1'
        ]);
        do{
            $id = mt_rand(10000, 99999);
            $event_id = 'EVT-'.$id;
        }while(Event::where('event_id', $event_id)->exists());

        $event_banner = $request->file('event_banner')->store('event_banners', 'public');
        $event = Event::create([
            'event_id'      => $event_id,
            'event_name'    => $validData['event_name'],
            'event_date'    => $validData['event_date'],
            'event_time'    => $validData['event_time'],
            'venue'         => $validData['venue'],
            'country_id'    => $validData['country'],
            'city_id'       => $validData['city'],
            'event_type'    => $validData['event_type'],
            'event_banner'  => $event_banner,
            'organizer_id'  => $validData['organizer'],
            'max_attendees' => $validData['max_attendees']
        ]);
        foreach($validData['inventory'] as $ticket){
            TicketInventory::create([
                'event_id' => $event->id,
                'ticket_type_name'   => $ticket['ticket_type_name'],
                'price'              => $ticket['price'],
                'max_quantity'       => $ticket['max_quantity'],
                'available_quantity' => $ticket['max_quantity']
            ]);
        }
        return redirect()->route('event.index')->with('success', 'Event Created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->with('inventory', 'ticket_purchase')->get();
        return view('event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $event->with('inventory')->get();
        $countries = Country::pluck('name', 'id');
        $organizers = Organizer::pluck('name', 'id');
        return view('event.edit', compact('event', 'countries', 'organizers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
         $validData = $request->validate([
            'event_name' => 'required|regex:/^[A-Za-z\s]+$/|max:100',
            'event_date' => 'required|after:tommorrow',
            'event_time' => 'required',
            'venue' => 'required|string',
            'city' => 'required',
            'country' => 'required',
            'event_type' => 'required',
            'event_banner' => 'file|image|mimes:jpg,png|max:500',
            'organizer' => 'required',
            'max_attendees' => 'required|numeric|min:1',

            'inventory' => 'required|array|min:1|max:3',
            'inventory.*.ticket_type_name' => 'required|alpha_num',
            'inventory.*.price' => 'required|numeric|min:0',
            'inventory.*.max_quantity' => 'required|numeric|min:1'
        ]);
        if($request->hasFile('event_banner')){
            Storage::disk('public')->delete($request->event_banner);
            $event_banner = $request->file('event_banner')->store('event_banners', 'public');
        }else
        {
            $event_banner = $event->event_banner;
        }
        $event->update([
            'event_name'    => $validData['event_name'],
            'event_date'    => $validData['event_date'],
            'event_time'    => $validData['event_time'],
            'venue'         => $validData['venue'],
            'country_id'    => $validData['country'],
            'city_id'       => $validData['city'],
            'event_type'    => $validData['event_type'],
            'event_banner'  => $event_banner,
            'organizer_id'  => $validData['organizer'],
            'max_attendees' => $validData['max_attendees']
        ]);
        foreach($request['inventory'] as $ticket){
            if(!empty($ticket['id'])){
                TicketInventory::where('id', $ticket['id'])->where('event_id', $event->id)->update([
                    'ticket_type_name'   => $ticket['ticket_type_name'],
                    'price'              => $ticket['price'],
                    'max_quantity'       => $ticket['max_quantity'],
                    'available_quantity' => $ticket['max_quantity']
                ]);
            }


        }
        return redirect()->route('event.index')->with('success', 'Event Details Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Event $event)
    {
        Storage::disk('public')->delete($event->event_banner);
        $event->delete();
        return back();
    }
    public function getCity(Request $request, City $city){
        $cities = City::where('country_id', $request->id)->get();
        $options = "<option value=''>--select--</option>";
        // dd($request);
        foreach($cities as $city){
            $selected = ($city->id == $request->city) ? 'selected':'';
            $options .= "<option value='{$city->id}' {$selected}>{$city->name}</option>";
        }
        return $options;
    }   


     public function filterData(Request $request){
        $query = Event::with('city', 'inventory', 'ticket_purchase');
        if($request->filled('event_type')){
            $query->where('event_type', $request->event_type);
        }
        if($request->filled('city_id')){
            $query->where('city_id', $request->city_id);
        }
        if($request->filled('available_tickets')){
            $query->whereHas('inventory', function($q)use($request){
                $q->where('available_quantity','>=',$request->available_tickets);
            });

        }

        $events = $query->get();
        return view('event.listpartial', compact('events'));
    }

    public function softList(Event $event){
        $events = Event::onlyTrashed()->get();
        return view('event.softlist', compact('events'));
    }
    public function restore($id){
        $event = Event::onlyTrashed()->findOrFail($id);
        $event->restore();
        return redirect()->route('event.index')->with('success', 'Event Restored Successfully!');
    }

    public function forceDelete($id){
        $event = Event::onlyTrashed()->findOrFail($id);
        $event->forceDelete();
        return redirect()->route('event.index')->with('success', 'Event Foce deleted');
    }

}
