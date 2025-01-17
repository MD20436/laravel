<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed</title>
    <link rel="stylesheet" href="{{ asset('global.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 text-center">
        <h1 class="text-success">Thank You!</h1>
        <p>Your order has been placed successfully.</p>
        <img src="{{ asset('images/order-thank-you.gif') }}" alt="Thank You" class="img-fluid mt-4" style="max-width: 400px;">
        <h3 class="mt-4">Your order is on the way!</h3>
        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4">Back to Dashboard</a>
    </div>
</body>
</html>
