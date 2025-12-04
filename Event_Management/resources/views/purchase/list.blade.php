@extends('layout.app')
@section('title', 'Purchase List')
@section('main')
    <div class="col-11">
        <div class="card my-5">
            <div class="card-header d-flex justify-content-between">
                <h3>Ticket Purchase Summary</h3>
                <a href="{{route('purchaseCreate')}}" class="btn btn-primary">Purchase</a>
            </div>
            @if (session()->get('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-body">
                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Attendee</th>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Venue</th>
                            <th>Ticket Type</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$purchase->attendee->name}}</td>
                                <td>{{$purchase->events->event_name}}</td>
                                <td>{{$purchase->events->event_date}}</td>
                                <td>{{$purchase->events->event_time}}</td>
                                <td>{{$purchase->events->venue}}</td>
                                <td>{{$purchase->ticket_type}}</td>
                                <td>{{$purchase->quantity}}</td>
                                <td>{{$purchase->total_price}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
