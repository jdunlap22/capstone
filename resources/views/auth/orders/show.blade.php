<h2>Order #{{ $order->id }}</h2>

<p>Customer Name: {{ $order->first_name }} {{ $order->last_name }}</p>
<p>Phone Number: {{ $order->phone }}</p>
<p>Email: {{ $order->email }}</p>
<p>Order Total: ${{ number_format($order->subtotal, 2) }}</p>

<h3>Order Details</h3>
<table>
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Item Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->soldItems as $soldItem)
        <tr>
            <td>{{ $soldItem->item->name }}</td>
            <td>${{ number_format($soldItem->item_price, 2) }}</td>
            <td>{{ $soldItem->quantity }}</td>
            <td>${{ number_format($soldItem->subtotal, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>