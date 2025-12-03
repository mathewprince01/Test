@section('main')
    <Div class="container-fluid">
        <div class="row">

            <form action="">
                <div class="mb-3">
                    <label for="event_name" class="form-label">Event Name</label>
                    <input type="text" id="event_name" name="event_name" value="{{ old('event_name') }}"
                        class="form-control">
                </div>
                @error('event_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="event_date" class="form-label">Event Date</label>
                    <input type="date" id="event_date" name="event_date" value="{{ old('event_date') }}"
                        class="form-control">
                    @error('event_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="event_time" class="form-label">Event Time</label>
                    <input type="time" id="event_time" name="event_time" value="{{ old('event_time') }}"
                        class="form-control">
                    @error('event_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="venue" class="form-label">Venue</label>
                    <input type="text" name="venue" id="venue" value="{{ old('venue') }}">
                    @error('venue')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <select name="country" id="country">
                        <option value="">--Select--</option>
                        @foreach ($countries as $id => $country)
                            <option value="{{ '$id' }}"name="country" @selected($id == old('country'))>
                                {{ $country }}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <select name="city" id="city">
                        <option value="">--City--</option>
                    </select>
                    @error('city')
                        <div class="alert alert-danger"></div>
                    @enderror
                </div>

                <div class="mb-3">
                    @php
                        $event_types = ['Conference', 'Workshop', 'Conert', 'Webinar'];
                    @endphp
                    <label for="event_type" class="form-label">Event Types</label>
                    <select name="event_type" id="event_type">
                        @foreach ($event_types as $event_type)
                            <option value="{{ $event_type }}">{{ $event_type }}</option>
                        @endforeach
                    </select>
                    @error('event_type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="event_banner" class="form-label">Event Banner</label>
                    <input type="file" name="event_banner" id="event_banner" value="{{ old('event_banner') }}">

                    @error('event_banner')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <select name="oraganizer" id="oraganizer">
                        @foreach ($organizers as $id => $organizer)
                            <option value="{{ $id }}">{{ $orgranizer }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="max_attendee" class="form-control">Max Attendees</label>
                    <input type="number" name="max_attendee" value="{{ old('max_attendee') }}">
                </div>
                @error('max_attendee')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @php
                    $oldDatas = old('inventory', []);
                @endphp

                <div class="rowGroup">
                    <div class="class-header">
                        @if (count($oldDatas > 0))
                            @foreach ($oldDatas as $i => $oldData)
                                <div class="rowItem d-flex gap 2 p-2">
                                    <div class="col-4">
                                        <label for="name{{ $i }}" class="form-label">Ticket_type_name</label>
                                        <input type="text" name="inventory[{{ $i }}][ticket_type_name]"
                                            id="name{{ $i }}" value="{{ $oldData[ticket_type_name] }}">
                                        @error('inventory.$i.ticket_type_name')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="name{{ $i }}" class="form-label">price</label>
                                        <input type="decimal" name="inventory[{{ $i }}][price]"
                                            id="name{{ $i }}" value="{{ $oldData[price] }}">
                                        @error('inventory.$i.price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="name{{ $i }}" class="form-label">Max Quantity</label>
                                        <input type="text" name="inventory[{{ $i }}][max_quantity]"
                                            id="name{{ $i }}"value="{{ $oldData[max_quantity] }}">
                                        @error(' inventory.$i.maxquantity')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="rowItem d-flex gap 2 p-2">
                             <div class="col-4">
                             <label for="name0" class="form-label">Ticket_type_name</label>
                                <input type="text" name="inventory[0][ticket_type_name]"id="name0" value="{{ $oldData[ticket_type_name] }}">
                                        @error('inventory.0.ticket_type_name')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="col-4">
                                        <label for="name0" class="form-label">price</label>
                                        <input type="decimal" name="inventory[0][price]"
                                            id="name0" value="{{ $oldData[price] }}">
                                        @error('inventory.0.price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                     <div class="col-4">
                                        <label for="name0" class="form-label">Max Quantity</label>
                                        <input type="text" name="inventory[0][max_quantity]"
                                            id="name0"value="{{ $oldData[max_quantity] }}">
                                        @error('inventory.0.maxquantity')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                        </div>

                    </div>
                    <div>
                        <button id="addrow">+</button>
                    </div>

                </div>
                <div>
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>


        </div>

    </Div>
@endsection

@push('scripts')
<script>
       $(document).ready(function(){
        $(document).on('change','#country',function(){
             let city="{{old('city')}}";
             let id=$('#country').val();
             $.ajax({
                url:"{{route('getcity')}}";
                method:"GET";
                data:{id,city};
                success:function(result){
                    $('#city').html(result)
                }
             })
        })
        let country=$('#country').val()
        if(country){
            $('#country').trigger('change');
        }

       })

    </script>
@endpush
