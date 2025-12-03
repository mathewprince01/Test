@extends('layout.app')
@section('title', 'Edit')
@section('main')
    <div class="col-md-11">
        <div class="card my-5">
            <div class="card-header">
                <h3>Event Details</h3>
                <a href="{{route('event.index')}}">Event List</a>
            </div>
            <div class="card-body">
                <table class="table">
                    {{-- @dd($event->inventory); --}}
                    <tr>
                        <th>Event Name</th>
                        <td>{{$event->event_name}}</td>
                    </tr>
                    <tr>
                        <th>Event date</th>
                        <td>{{$event->event_date}}</td>
                    </tr>
                    <tr>
                        <th>Venue</th>
                        <td>{{$event->venue}}</td>
                    </tr>
                    <tr>
                        <th> Organizer</th>
                        <td>{{$event->organizer->name}}</td>
                    </tr>
                    <tr>
                        <th> Available Quantity</th>
                        <td>{{$event->inventory->sum('available_quantity')}}</td>
                    </tr>
                </table>
            </div>
            <div class="card-header">
                <h3>Ticket Sales Summary</h3>
            </div>
             <div class="card-body">
                <table class="table w-50 table-bordered">
                    <tr>
                        <th>Total Sold</th>
                        <td>{{$event->ticket_purchase->sum('quantity')}}</td>
                    </tr>
                    <tr>
                        <th>Revenue</th>
                        <td>{{$event->ticket_purchase->sum('total_price')}}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
@endsection
