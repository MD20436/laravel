<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Submit Review for {{ $order->restaurant->name }}</h1>
        <p class="text-center">Order completed on {{ $order->updated_at->format('d-m-Y H:i') }}</p>
        <form action="{{ route('orders.submitReview', $order->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="stars" class="form-label">Rating (1-5 stars)</label>
                <select name="stars" id="stars" class="form-select" required>
                    <option value="">Choose...</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @error('stars')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Review</label>
                <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
            <a href="{{ route('orders.history') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>