<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">
    <script src="{{ asset('theme.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Order History</a>
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Order History</h1>
        @if ($completedOrders->isEmpty())
            <p class="text-center">You have no orders yet.</p>
        @else
            @foreach ($completedOrders as $order)
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            Order from {{ $order->restaurant->name }}
                            <span class="badge 
                                @if($order->status === 'oczekiwanie') bg-warning 
                                @elseif($order->status === 'przyjęte') bg-info 
                                @elseif(in_array($order->status, ['completed', 'dostarczone'])) bg-success 
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <small>Placed on {{ $order->created_at->format('d-m-Y H:i') }}</small>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($order->menuItems as $item)
                                <li class="list-group-item d-flex align-items-center">
                                    <img src="{{ asset('images/menu/' . $item->image) }}" alt="{{ $item->name }}" class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div>
                                        <strong>{{ $item->name }}</strong> - Quantity: {{ $item->pivot->quantity }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <h5 class="mt-3">Total: ${{ number_format($order->total_price, 2) }}</h5>
                        @if(in_array($order->status, ['completed', 'dostarczone']))
                            <a href="{{ route('orders.review', $order->id) }}" 
                               class="btn btn-primary mt-3" 
                               {{ $order->review ? 'disabled' : '' }}>
                                Write a Review
                            </a>
                            <p class="mt-2 text-muted">
                                {{ $order->review ? 'You have already written a review for this order.' : '' }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <script src="{{ asset('theme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
