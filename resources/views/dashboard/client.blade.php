<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Client Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link btn btn-link" type="submit">Logout</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.current') }}">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Panel Klienta</h1>
        <p class="text-center">Witamy w panelu zamówień.</p>
        <div class="row">
            @foreach($restaurants as $restaurant)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('images/restaurants/' . $restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $restaurant->name }}</h5>
                            <p class="card-text">Category: {{ $restaurant->category }}</p>
                            <p class="card-text d-flex align-items-center">
                                <img src="{{ asset('images/review-icon.png') }}" alt="Review Icon" class="me-2" style="width: 24px; height: 24px;">
                                <a href="{{ route('restaurants.reviews', $restaurant->id) }}">
                                    Average Rating: {{ number_format($restaurant->average_stars, 1) }}/5
                                </a>
                            </p>
                            <a href="{{ route('restaurants.show', $restaurant->id) }}" class="btn btn-primary">View Menu</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
