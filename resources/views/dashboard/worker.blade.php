<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Worker Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('restaurants.reviews', $restaurant->id) }}">View Reviews</a>
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
        <h1 class="text-center">Panel Pracownika</h1>
        <p class="text-center">Obsługa zamówień dla restauracji <strong>{{ $restaurant->name }}</strong></p>

        @if($orders->isEmpty())
            <p class="text-center">Brak zamówień dla tej restauracji.</p>
        @else
        <table class="table table-striped">
    <thead>
        <tr>
            <th>ID Zamówienia</th>
            <th>Klient</th>
            <th>Data Zamówienia</th>
            <th>Status</th>
            <th>Szczegóły</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>
                    <ul>
                        @foreach($order->menuItems as $item)
                            <li>{{ $item->name }} - Ilość: {{ $item->pivot->quantity }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
    @if($order->status === 'oczekiwanie')
        <form method="POST" action="{{ route('orders.accept', $order->id) }}" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success">Przyjmij</button>
        </form>
    @endif

    @if($order->status === 'przyjęte' || $order->status === 'oczekiwanie')
        <form method="POST" action="{{ route('orders.deliver', $order->id) }}" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-primary">Dostarczone</button>
        </form>
    @endif
</td>

            </tr>
        @endforeach
    </tbody>
</table>

        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
