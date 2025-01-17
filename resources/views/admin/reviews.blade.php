<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reviews</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">All Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.workers') }}">Workers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.reviews') }}">Reviews</a>
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
        <h1 class="text-center">All Reviews</h1>
        @if($reviews->isEmpty())
            <p class="text-center">No reviews available.</p>
        @else
            @foreach($reviews as $review)
                <div class="card mb-3">
                <div class="card-header">
    <strong>Review for:</strong> {{ $review->restaurant->name ?? 'Unknown Restaurant' }}<br>
    <strong>By:</strong> {{ $review->user ? $review->user->name : 'Unknown User' }}<br>
    <strong>Rating:</strong> {{ $review->stars }}
</div>

                    <div class="card-body">
                        <p class="card-text"><strong>Review:</strong> {{ $review->description }}</p>
                        <h6>Comments:</h6>
                        @if($review->comments->isEmpty())
                            <p>No comments available for this review.</p>
                        @else
                            <ul class="list-group">
                                @foreach($review->comments as $comment)
                                    <li class="list-group-item">
                                        <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }} <br>
                                        <small class="text-muted">Added on {{ $comment->created_at->format('d-m-Y H:i') }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <form method="POST" action="{{ route('admin.reviews.delete', $review) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Review</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
