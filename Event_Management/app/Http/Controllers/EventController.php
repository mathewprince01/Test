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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate(

            [
                'event_name'=>'required |regax:/^[a-zA-Z\s]+$/',
                'event_date'=>'required',
                'event_time'=>'required',
                'venue'=>'required',
                'country'=>'required',
                'city'=>'required',
                'event_type'=>'required|string|in:conference,workshop,conert,webinar',
                'event_banner'=>'file|image|mimes:png,jpg|max:1000',
                'organizer'=>'required',
                'max_attendee'=>'required',
                'inventory'=>'required',
                'inventory.*.ticket_type_name'=>'required|string',
                'inventory.*.price'=>'required|string',
                'inventory.*.max_quantity'=>'required|string'
            ]

        );

        do{
            $event_id=mt_rand(100000,999999);
        }while(Event::where('event_id',$event_id)->exists());
         $event_banner=$request->file('event_banner')->store('public,event_photos');
        $event_type=implode(',',$validate['event_type']);

        $event=Event::create(
            ['event_name'=>$validate['event_name'],
             'event_date'=>$validate['event_date'],
             'event_time'=>$validate['event_time'],
             'venue'=>$validate['venue'],
             'country'=>$validate['country'],
             'city'=>$validate['city'],
             'event_type'=>$event_type,
             'event_banner'=>$event_banner,
             'organizer'=>$validate['organizer'],
             'max_attendee'=>$validate['max_attendee']

            ]
        );
        $inventory=TicketInventory::create([
            'ticket_type_name'=>$validate['ticket_type_name'],
            'price'=>$validate['price'],
            'max_quantity'=>$validate['max_quantity'],



        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validate=$request->validate(  [

        'event_name'=>'required |regax:/^[a-zA-Z\s]+$/',
        'event_date'=>'required',
        'event_time'=>'required',
        'venue'=>'required',
         'country'=>'required',
         'city'=>'required',
         'event_type'=>'required|string|in:Conference,Workshop,Concert,Webinar',
         'event_banner'=>'file|image|mimes:png,jpg|max:1000',
         'organizer'=>'required',
         'max_attendee'=>'required'
         ]   );

          do{
            $event_id=mt_rand(100000,999999);
        }while(Event::where('event_id',$event_id)->exists());
         $event_banner=$request->file('event_banner')->store('public,event_photos');
        $event_type=implode(',',$validate['event_type']);

        $event=Event::update([
            'event_name'=>$validate['event_name'],
            'event_date'=>$validate['event_date'],
            'event_time'=>$validate['event_time'],
            'venue'=>$validate['venue'],
            'country'=>$validate['country'],
            'city'=>$validate['city'],
            'event_type'=>$event_type,
            'event_banner'=>$event_banner,
            'organizer'=>$validate['organizer'],
            'max_attendee'=>$validate['max_attendee']

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public  function getcity(Request $id,City $city)
    {
                $cities=City::where('country_id',$id)->get();

    }
}
