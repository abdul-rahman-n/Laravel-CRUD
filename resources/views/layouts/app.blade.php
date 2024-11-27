<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('customers.index') }}">Customer Management</a>
    </nav>

    <main class="py-4">
        <div class="container">
            @if (session('success'))
            <div id="alert-message" class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div id="alert-message" class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Select all alert messages
            const alerts = document.querySelectorAll('.alert');

            // Set a timeout to hide each alert after 5 seconds
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0'; // Start fading out

                    setTimeout(() => {
                        alert.remove(); // Remove from DOM after fade-out
                    }, 500); // Wait for the fade-out transition
                }, 5000); // 5000ms = 5 seconds delay
            });
        });
    </script>
</body>

</html>