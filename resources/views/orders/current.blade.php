<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Order Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Back to Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link btn btn-link" type="submit">Logout</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Your Current Orders</h1>
        @forelse($orders as $order)
            @if($order->menuItems->isNotEmpty())
                <div class="card mt-4">
                    <div class="card-header">
                        Order from {{ $order->restaurant->name }}
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($order->menuItems as $item)
                                <li class="list-group-item d-flex align-items-center">
                                    <img src="{{ asset('images/menu/' . $item->image) }}" alt="{{ $item->name }}" class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div class="me-auto">
                                        <strong>{{ $item->name }}</strong> - Quantity: {{ $item->pivot->quantity }} - Price: ${{ number_format($item->pivot->quantity * $item->price, 2) }}
                                    </div>
                                    <form method="POST" action="{{ route('orders.update', [$order->id, $item->id]) }}" class="d-flex">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="decrease">
                                        <button type="submit" class="btn btn-danger me-2" {{ $item->pivot->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                    </form>
                                    <form method="POST" action="{{ route('orders.update', [$order->id, $item->id]) }}" class="d-flex">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="increase">
                                        <button type="submit" class="btn btn-success">+</button>
                                    </form>
                                    <form method="POST" action="{{ route('orders.remove', [$order->id, $item->id]) }}" class="ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning">Remove</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <h5 class="mt-3">Total: ${{ number_format($order->total_price, 2) }}</h5>
                        <a href="{{ route('restaurants.show', $order->restaurant->id) }}" class="btn btn-primary mt-3">Order More</a>
                        <a href="{{ route('active_orders.create', $order->id) }}" class="btn btn-success mt-3">Submit Order</a>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center">
                <img src="{{ asset('images/empty-cart.png') }}" alt="Empty Cart" class="img-fluid" style="max-width: 300px;">
                <p class="mt-4">You have no current orders. Start your journey now!</p>
                <a href="{{ url('/restaurants/' . rand(1, 3)) }}" class="btn btn-primary">Order Now</a>
            </div>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
