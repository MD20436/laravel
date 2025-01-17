<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Restaurants</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.workers') }}">Workers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.reviews') }}">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.restaurants') }}">Restaurants</a>
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
        <h1 class="text-center">All Restaurants</h1>
        @if($restaurants->isEmpty())
            <p class="text-center">No restaurants found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($restaurants as $restaurant)
                        <tr>
                            <td>{{ $restaurant->id }}</td>
                            <td>{{ $restaurant->name }}</td>
                            <td>{{ $restaurant->category }}</td>
                            <td>{{ $restaurant->created_at->format('d-m-Y H:i') }}</td>
                            <td>
    <a href="{{ route('admin.restaurants.details', $restaurant->id) }}" class="btn btn-sm btn-primary">Details</a>
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
