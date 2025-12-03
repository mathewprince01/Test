@extends('layout.app')
@section('title', 'Soft Deleted List')
@section('main')
    <div class="col-md-11">
        <div class="card my-5">
            <div class="card-header">
                <h3>Soft Deleted List</h3>
                <a href="{{route('event.index')}}">Event List</a>
            </div>
            <div class="card-body text-center">
                <table class="table table-responsive table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>S.No</th>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Organizer</th>
                            <th>Total Ticket Sold</th>
                            <th>Available Tickets</th>
                            <th>Total Revenue</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$event->event_name}}</td>
                                <td>{{$event->event_date}}</td>
                                <td>{{$event->venue}}</td>
                                <td>{{$event->organizer->name}}</td>
                                <td>{{$event->ticket_purchase->sum('quantity')}}</td>
                                <td>{{$event->inventory->sum('available_quantity')}}</td>
                                <td>{{$event->ticket_purchase->sum('total_price')}}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{route('restore',$event->id)}}" class="btn btn-info">Restore</a>
                                        <form action="{{route('forceDelete',$event->id)}}" method="post" onsubmit="return confirm('Are You Sure?')">
                                            @csrf
                                            <button class="btn btn-danger">Force delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
