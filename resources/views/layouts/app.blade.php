<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Importing Cairo font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif; /* Applying Cairo font */
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Header -->
    <header class="relative p-8 bg-white shadow-lg flex items-center justify-center">
        <!-- Left Image -->
        <img src="{{ asset('logo.png') }}" alt="Logo 1" class="hidden md:block absolute left-4 h-10">

        <!-- Centered Text -->
        <div class="text-center">
            <h1 class="text-sm font-bold">جامعة الشرق الأوسط - كلية الآداب و العلوم التربوية</h1>
        </div>

        <!-- Right Image -->
        <img src="{{ asset('logo2.jpg') }}" alt="Logo 2" class="absolute right-4 h-10">
    </header>


    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-200 text-center p-4">
        <p class="text-sm text-gray-600">&copy; إعداد الدكتور: أحمد عبدالسميع طبية</p>
    </footer>
</body>

</html>
