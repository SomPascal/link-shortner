<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
    
    <title>
        Link Shortner - @yield('title')
    </title>
</head>
<body class="bg-blue-500 flex align-center justify-center">
    <section class="container mt-20 flex align-center justify-center">
        @yield('content')
    </section>
</body>
</html>