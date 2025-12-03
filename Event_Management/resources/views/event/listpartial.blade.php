                        @foreach ($events as $event )
                        {{-- @dd($event->inventory); --}}
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
                                        <a href="{{route('event.show',$event->id)}}" class="btn btn-info">Event Details</a>
                                        <a href="{{route('event.edit',$event->id)}}" class="btn btn-warning">Edit</a>
                                        <form action="{{route('event.destroy',$event->id)}}" method="post" onsubmit="return confirm('Are You Sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
