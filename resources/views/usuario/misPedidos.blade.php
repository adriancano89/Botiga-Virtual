<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/chatbot.js') }}" defer></script>
    <title>Mis Pedidos</title>
</head>
<body>
    @include('General.header')
    @include('Usuarios.barraLateral')
    @include('General.footer')
</body>
</html>