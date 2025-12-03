@section('main')
    <div class="container-fluid">
        <div class="row">
            <form action="{{route('event.update')}}">
             <div class="mb-3">
                <label for="event_name" class="form-label">Event Name</label>
                <input type="text" name="event_name" id="event_name" value="{{old('event_name')}}" class="form-control">
                @error('event_name')
                 <div class="alert alert-danger">{{$message}}</div>
                @enderror
             </div>
            <div class="mb-3">
             <label for="event_date" class="form-label">Event Date</label>
             <input type="date" id="event_date" name="event_date" class="form-control" value="{{old('event_date')}}">
             @error('event_date')
                  <div class="alert alert-danger">{{$message}}</div>
             @enderror
            </div>
              <div class="mb-3">
                <label for="event_time" class="form-label">Event Time</label>
                <input type="time" class="form-control" name="event_time" value="{{old('event_time')}}">
                @error('event_time')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
              </div>
              <div class="mb-3">
                 <label for="venue"  class="form-control">Venue</label>
                 <input type="text" name="venue" id="venue" class="form-control" value="{{old('venue')}}">
                 @error('venue')
                     <div class="alert alert-danger">{{$message}}</div>
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
                @php
                    $event_types=['Conference','Workshop','Concert','Webinar']
                @endphp
                <div class="mb-3">
                <select name="event_type" id="event_type">
                    <option value="">--Select--</option>
                    @foreach ($event_types as $event_type)
                        <option value="{{$event_type}}">{{$event_type}}</option>
                    @endforeach
                </select>
                </div>
                <div class="mb-3">
                    <label for="event_banner"  class="form-label">Event Banner</label>
                    <input type="file" name="event_banner" id="event_banner"  value="{{old('event_banner')}}">
                @error('event_banner')
                <div class="alert alert-banger">{{$message}}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="organizer" class="form-label">organizer</label>
                    @foreach ($organizers as $id=>$oraganizer)
                     <option value="{{$id}}">{{$organizer}}</option>
                    @endforeach
                    @error('organizer')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="max-attendee">Max Attendee</label>
                    <input type="integer" name="max_attendee"  value="{{old('max_attendee')}}">
                    @error('max_attendee')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>


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
                                        <label for="name{{$i}}" class="form-label">price</label>
                                        <input type="number" name="inventory[{{$i}}][price]">

                                    </div>
            </form>
        </div>

    </div>
@endsection
