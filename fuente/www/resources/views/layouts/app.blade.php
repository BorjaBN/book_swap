<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookSwap - @yield('titulo', 'Hola')</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/base.css') }}">

    @stack('estilos')
    @livewireStyles

</head>
<body>

  

<div class="page-wrapper">

 
    @yield('header')

    <x-toast />

    <main>
        @yield('main')
    </main>

</div>


@yield('footer')


@stack('scripts')

@livewireScripts

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function abrirModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function cerrarModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>

</body>
</html>
