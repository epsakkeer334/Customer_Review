<!DOCTYPE html>
<html>
<head>
    <title>Customer Reviews</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Customer Reviews</a>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
