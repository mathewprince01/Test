@extends('layout.app')
@section('title', 'Edit')
@section('main')
    <div class="col-md-11">
        <div class="card my-5">
            <div class="card-header">
                <h3>Update</h3>
                <a href="{{route('event.index')}}">Event List</a>
            </div>
            {{-- @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif --}}
            <div class="card-body">
                <form action="{{route('event.update',$event->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="event_name" class="form-label">Event Name:</label>
                        <input type="text" name="event_name" id="event_name" class="form-control" value="{{old('event_name',$event->event_name)}}">
                        @error('event_name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="event_date" class="form-label">Event Date:</label>
                        <input type="date" name="event_date" id="event_date" class="form-control w-50" value="{{old('event_date',$event->event_date)}}">
                        @error('event_date')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="event_time" class="form-label">Event Time:</label>
                        <input type="time" name="event_time" id="event_time" class="form-control w-50" value="{{old('event_time',$event->event_time)}}">
                        @error('event_time')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="venue" class="form-label">Event Name:</label>
                        <input type="text" name="venue" id="venue" class="form-control" value="{{old('venue',$event->venue)}}">
                        @error('venue')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    @php
                        $event_types = ['Conference', 'Workshop', 'Concert', 'Webinar']
                    @endphp
                    <label for="event_type" class="form-label">Event Type :</label>
                    <div class="mb-2">
                        <select name="event_type" id="event_type" class="form-select">
                            <option value="">--select--</option>
                            @foreach ($event_types as $event_type)
                                <option value="{{$event_type}}" @selected($event_type == $event->event_type)>{{$event_type}}</option>
                            @endforeach
                        </select>
                        @error('event_type')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="country" class="form-label"> Country :</label>
                        <select name="country" id="country" class="form-select">
                            <option value="">--select--</option>
                            @foreach ($countries as $i=>$country)
                                <option value="{{$i}}" @selected($event->country_id == $i)>{{$country}}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="city" class="form-label"> City :</label>
                        <select name="city" id="city" class="form-select">
                            <option value="">--select--</option>
                        </select>
                        @error('city')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="event_banner">Event Banner :</label>
                        <input type="file" name="event_banner" id="event_banner" class="form-control">
                        <div class="mt-2">
                            <img src="{{asset('storage/'.$event->event_banner)}}" class="img-thumbnail" width="80" height="90">
                        </div>
                        @error('event_banner')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                     <div class="mb-2">
                        <label for="organizer" class="form-label"> Organizer :</label>
                        <select name="organizer" id="organizer" class="form-select">
                            <option value="">--select--</option>
                            @foreach ($organizers as $i=>$organizer)
                                <option value="{{$i}}" @selected($event->organizer_id == $i)>{{$organizer}}</option>
                            @endforeach
                        </select>
                        @error('organizer')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="max_attendees">Event Banner :</label>
                        <input type="number" name="max_attendees" id="max_attendees" class="form-control w-50" value="{{old('max_attendees',$event->max_attendees)}}">
                        @error('max_attendees')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    @php
                        $oldDatas = old('inventory', $event->inventory);
                    @endphp
                    <div class="rowGroup">
                        <div class="card-header">
                            <h3>Tickets</h3>
                        </div>
                        @if(count($oldDatas) > 0)
                            @foreach ($oldDatas as $i=>$oldData )
                                <div class="rowItem d-flex gap-2 p-2">
                                    <input type="hidden" name="inventory[{{$i}}][id]" value="{{$oldData['id']}}">
                                    <div class="col-4">
                                        <label for="name{{$i}}" class="form-label"> Ticket Type Name:</label>
                                        <input type="text" name="inventory[{{$i}}][ticket_type_name]" id="name{{$i}}" value="{{$oldData['ticket_type_name']}}" class="form-control">
                                        @error("inventory.$i.ticket_type_name")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="price{{$i}}" class="form-label"> Ticket Price:</label>
                                        <input type="text" name="inventory[{{$i}}][price]" id="price{{$i}}" value="{{$oldData['price']}}" class="form-control">
                                        @error("inventory.$i.price")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <label for="max_quantity{{$i}}" class="form-label"> Maximum Quantity:</label>
                                        <input type="text" name="inventory[{{$i}}][max_quantity]" id="max_quantity{{$i}}" value="{{$oldData['max_quantity']}}" class="form-control">
                                        @error("inventory.$i.max_quantity")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-1 text-center mt-3">
                                        <a class="btn btn-danger removeRow">-</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="rowItem d-flex gap-2 p-2">
                                <div class="col-4">
                                    <label for="name0" class="form-label"> Ticket Type Name:</label>
                                    <input type="text" name="inventory[0][ticket_type_name]" id="name0" value="{{old('ticket_type_name')}}" class="form-control">
                                    @error("inventory.0.ticket_type_name")
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="price0" class="form-label"> Ticket Price:</label>
                                    <input type="text" name="inventory[0][price]" id="price0" value="{{old('price')}}" class="form-control">
                                    @error("inventory.0.price")
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <label for="max_quantity0" class="form-label"> Maximum Quantity:</label>
                                    <input type="text" name="inventory[0][max_quantity]" id="max_quantity0" value="{{old('max_quantity')}}" class="form-control">
                                    @error("inventory.0.max_quantity")
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-1 text-center mt-3">
                                    <a class="btn btn-danger removeRow">-</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    @error('inventory')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <div class="mb-3">
                        <a class="btn btn-success addRow">+</a>
                    </div>
                    <div class="">
                        <button class="btn btn-primary" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $(document).on('change', '#country', function(){
                let id = $('#country').val();
                let city = "{{old('city',$event->city_id)}}";

                $.ajax({
                    url : "{{route('getcity')}}",
                    method : "GET",
                    data : {id, city},
                    success : function(result){
                        $('#city').html(result)
                        $('#city').val(city);
                    }
                })
            });
            let country = $('#country').val();
            if(country){
                $('#country').trigger('change');
            }

            $(document).on('click', '.addRow', function(){
                let rowCount = $('.rowItem').length;

                if(rowCount < 3){
                    let html = `
                       <div class="rowItem d-flex gap-2 p-2">
                            <div class="col-4">
                                <label for="name${rowCount}" class="form-label"> Ticket Type Name:</label>
                                <input type="text" name="inventory[${rowCount}][ticket_type_name]" id="name${rowCount}" class="form-control">
                                @error('inventory[${rowCount}][ticket_type_name]')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="price${rowCount}" class="form-label"> Ticket Price:</label>
                                <input type="text" name="inventory[${rowCount}][price]" id="price${rowCount}" class="form-control">
                                @error('inventory[${rowCount}][price]')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label for="max_quantity${rowCount}" class="form-label"> Maximum Quantity:</label>
                                <input type="text" name="inventory[${rowCount}][max_quantity]" id="max_quantity${rowCount}"  class="form-control">
                                @error('inventory[${rowCount}][max_quantity]')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-1 text-center mt-3">
                                <a class="btn btn-danger removeRow">-</a>
                            </div>
                        </div>
                    `;
                    $('.rowGroup').append(html)
                    rowCount++;
                }
            })
            $(document).on('click', '.removeRow', function(){
                let rowCount = $('.rowItem').length;
                if(rowCount > 1){
                    $(this).closest('.rowItem').remove();
                }
            });

        });
    </script>
@endpush


