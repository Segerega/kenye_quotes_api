<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .bg-dark {
            background-color: #333 !important;
        }
        .navbar-dark .navbar-brand {
            color: #fff;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8);
        }
        .container {
            height: 100%;
        }
    </style>
</head>
<body class="bg-dark">

<main class="py-4">
    @yield('content')
</main>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.5/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
