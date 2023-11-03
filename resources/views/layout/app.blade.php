<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @include('partials.styles')

  </head>
  <body class="bg-gray-100">

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

  </body>
</html>
