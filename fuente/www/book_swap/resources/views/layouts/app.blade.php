<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookSwap - @yield('titulo', 'Hola')</title>


    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  {{-- Aquí podrías añadir tu CSS propio --}}
  @stack('estilos')
  @stack('scripts')
</head>
<body>

  {{-- Header (luego lo convertiremos en componente) --}}
  @yield('header')

  <main>
    @yield('main')
  </main>

  {{-- Footer (luego lo convertiremos en componente) --}}
  @yield('footer')

</body>
</html>
