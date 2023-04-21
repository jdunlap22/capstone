<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Order Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
            <td>${{ number_format($order->subtotal, 2) }}</td>
            <td>
                <a href="{{ route('orders.show', $order->id) }}">View Receipt</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>