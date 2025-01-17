<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Active Order</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Complete Your Order</h1>
        <form action="{{ route('active_orders.store', $order->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="delivery_method">Delivery Method</label>
        <select name="delivery_method" id="delivery_method" class="form-control">
            <option value="pickup">Pickup</option>
            <option value="delivery">Delivery</option>
        </select>
    </div>
    <div id="address-fields" style="display: none;">
        <div class="form-group mt-3">
            <label for="address">Street Address</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>
        <div class="form-group mt-3">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control">
        </div>
        <div class="form-group mt-3">
            <label for="postal_code">Postal Code</label>
            <input type="text" name="postal_code" id="postal_code" class="form-control">
        </div>
        <div class="form-group mt-3">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>
    </div>
    <div class="form-group mt-3">
        <label for="payment_method">Payment Method</label>
        <select name="payment_method" id="payment_method" class="form-control">
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="online">Online</option>
        </select>
    </div>
    <div class="form-group mt-3">
    <h4>Order Summary</h4>
    <ul class="list-group">
        @foreach ($order->menuItems as $item)
            <li class="list-group-item">
                {{ $item->name }} - Quantity: {{ $item->pivot->quantity }} - Price: ${{ number_format($item->price * $item->pivot->quantity, 2) }}
            </li>
        @endforeach
    </ul>
    <h5 class="mt-3">Total: ${{ number_format($order->total_price, 2) }}</h5>
</div>

    <button type="submit" class="btn btn-primary mt-3">Submit Order</button>
</form>
<script>
    document.getElementById('delivery_method').addEventListener('change', function () {
        const addressFields = document.getElementById('address-fields');
        if (this.value === 'delivery') {
            addressFields.style.display = 'block';
        } else {
            addressFields.style.display = 'none';
        }
    });
</script>
</body>
</html>
