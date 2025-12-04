
    <h3>Hi {{$purchase->attendee->name}}</h3><br>

    <p>Thank You for Purchasing Tickets for {{$purchase->events->event_name}}</p>

    <p>Ticket Type : {{$purchase->ticket_type}}</p>

    <p>Ticket Quantity : {{$purchase->quantity}}</p>

    <p>Total Price : {{$purchase->total_price}}</p><br><br>

    <h3>Thanks,</h3>
