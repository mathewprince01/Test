@extends('layout.app')
@section('title', 'Purchase Create')
@section('main')
    <div class="col-11">
        <div class="card my-5">
            <div class="card-header">
                <h3>Purchase</h3>
                <a href="{{route('purchaseIndex')}}">Purchase index</a>
            </div>
            <div class="card-body">
                <form action="{{route('purchaseStore')}}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="event_id" class="form-label">Event Name: </label>
                        <select name="event_id" id="event_id" class="form-select">
                            <option value="">--select--</option>
                            @foreach ($events as $event )
                                <option value="{{$event->id}}" @selected(old('event_id') == $event->id)>{{$event->event_name}}</option>
                            @endforeach
                        </select>
                        @error('event_id')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ticket_type" class="form-label">Ticket Type: </label>
                        <select name="ticket_type" id="ticket_type" class="form-select">
                            <option value="">--select--</option>
                        </select>
                        @error('ticket_type')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label"> Quantity: </label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="{{old('quantity')}}">
                       <div id="available"></div>
                        @error('quantity')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Purchase</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function(){

            $(document).on('change', '#event_id', function(){
                let event_id = $('#event_id').val();
                let ticket_type_id = "{{old('ticket_type')}}";

                $.ajax({
                    url : "{{route('getTicketType')}}",
                    method : "GET",
                    data : {event_id, ticket_type_id},
                    success : function(data){
                        $('#ticket_type').html(data)
                    }
                })
            });
            let id = $('#event_id').val();
            if(id){
                $('#event_id').trigger('change');
            }
        });
          $(document).on('change', '#ticket_type', function(){
                let ticket_id = $(this).val();

                $.ajax({
                    url : "{{route('getQuantity')}}",
                    method : "GET",
                    data : {ticket_id},
                    success : function(data){
                        $('#available').html(data.quantity);
                        $('#quantity').attr('max',data.max);
                    }
                })
            });
            let id = $('#ticket_type').val();
            if(id){
                $('#ticket_type').trigger('change');
            }
    </script>

@endpush
