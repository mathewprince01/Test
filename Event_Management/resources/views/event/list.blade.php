@extends('layout.app')
@section('title', 'Event List')
@section('main')
    <div class="col-md-11">
        <div class="card my-5">
            <div class="card-header d-flex justify-content-between">
                <h3>Event List</h3>
                <div class="d-flex gap-3">
                    <a href="{{route('event.create')}}" class="btn btn-primary">Add Event</a>
                    <a href="{{route('softList')}}" class="btn btn-info">Soft List</a>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @php
                 $event_types = ['Conference', 'Workshop', 'Concert', 'Webinar'];
            @endphp
            <div class="row mt-2 p-2">
                <div class="col-4">
                    <label for="event_type" class="form-label">Event Type :</label>
                    <select name="event_type" id="event_type" class="form-select">
                        <option value="">--select--</option>
                        @foreach ($event_types as $event_type )
                            <option value="{{$event_type}}">{{$event_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="city_id" class="form-label">City :</label>
                    <select name="city_id" id="city_id" class="form-select">
                        <option value="">--select--</option>
                        @foreach ($cities as $id=>$city )
                            <option value="{{$id}}">{{$city}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="available_tickets">Available Tickets</label>
                    <input type="number" name="available_tickets" id="available_tickets" class="form-control">
                </div>
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
                    <tbody id="filterData">
                        @include('event.listpartial')

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#event_type,#city_id,#available_tickets').on('change', function(){
                let event_type = $('#event_type').val();
                let city_id = $('#city_id').val();
                let available_tickets = $('#available_tickets').val();

                $.ajax({
                    url : "{{route('filterData')}}",
                    method : "GET",
                    data : {event_type, city_id, available_tickets},
                    success : function(data){
                        $('#filterData').html(data);
                    },
                    error : function(xhr){
                        console.log(xhr.responseText);
                    },
                });
            });
        });
    </script>
@endpush
