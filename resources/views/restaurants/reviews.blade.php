<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews for {{ $restaurant->name }}</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Reviews for {{ $restaurant->name }}</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
        
        @forelse($reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Rating: {{ $review->stars }}/5</h5>
                    <p class="card-text">{{ $review->description }}</p>
                    <h6>Comments:</h6>
                    <ul class="list-group mb-3">
                        @foreach($review->comments as $comment)
                            <li class="list-group-item">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                                <small class="text-muted d-block">Added on {{ $comment->created_at->format('d-m-Y H:i') }}</small>
                                
                                @if(auth()->user()->id === $comment->user_id || auth()->user()->roles->contains('name', 'Pracownik'))
                                    <div class="mt-2">
                                        <!-- Edit button -->
                                        <button class="btn btn-sm btn-warning" onclick="showEditForm({{ $comment->id }})">Edit</button>
                                        <!-- Delete form -->
                                        <form action="{{ route('restaurants.comments.destroy', [$restaurant->id, $comment->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                    <!-- Hidden edit form -->
                                    <div id="edit-form-{{ $comment->id }}" class="mt-2 d-none">
                                        <form action="{{ route('restaurants.comments.update', [$restaurant->id, $comment->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="text" name="comment" class="form-control mb-2" value="{{ $comment->comment }}" required>
                                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                                            <button type="button" class="btn btn-sm btn-secondary" onclick="hideEditForm({{ $comment->id }})">Cancel</button>
                                        </form>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <!-- Add comment form - only for workers -->
                    @if(auth()->user()->roles->contains('name', 'Pracownik'))
                        <form action="{{ route('restaurants.comments.store', [$restaurant->id, $review->id]) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="comment" class="form-control" placeholder="Add a comment..." required>
                                <button type="submit" class="btn btn-primary">Submit Comment</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-center">No reviews available for this restaurant.</p>
        @endforelse
    </div>
    <script>
        function showEditForm(commentId) {
            document.getElementById(`edit-form-${commentId}`).classList.remove('d-none');
        }

        function hideEditForm(commentId) {
            document.getElementById(`edit-form-${commentId}`).classList.add('d-none');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
