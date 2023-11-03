<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <h1 class="text-3xl font-bold mb-4">404 - Page Not Found</h1>
        <p class="text-gray-600">Please Give Authntic email address and password.</p>
        <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">Go to Login Page</a>
    </div>

</body>

</html>
