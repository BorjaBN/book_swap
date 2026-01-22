<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookSwap - @yield('titulo', 'Hola')</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
  {{-- Aquí podrías añadir tu CSS propio --}}
  @stack('estilos')
  @livewireStyles

</head>
<body>

<div class="page-wrapper">

  {{-- Header (luego lo convertiremos en componente) --}}
  @yield('header')

  <main>
    @yield('main')
  </main>
</div>
  {{-- Footer --}}
  @yield('footer')

{{-- Scripts globales--}}
@stack('scripts')

{{-- JS global para modales --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@livewireScripts

</body>
</html>
