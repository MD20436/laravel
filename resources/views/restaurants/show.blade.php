<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant->name }}</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Restaurant Details</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Back to Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.current') }}">My Orders</a>
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
        <h1 class="text-center">{{ $restaurant->name }}</h1>
        <p class="text-center">Category: {{ $restaurant->category }}</p>
        <div class="row">
            @foreach($restaurant->menuItems as $menuItem)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('images/menu/' . $menuItem->image) }}" class="card-img-top" alt="{{ $menuItem->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menuItem->name }}</h5>
                            <p class="card-text">{{ $menuItem->description }}</p>
                            <p class="card-text">Price: ${{ $menuItem->price }}</p>
                            <form method="POST" action="{{ route('orders.add', $menuItem->id) }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="1" min="1">
                                    <button type="submit" class="btn btn-primary">Add to Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
