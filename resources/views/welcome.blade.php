<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel Vue Jwt Crud</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            </style>
    </head>
    <body>
        <div id="app"></div>
    </body>
    <!-- Scripts -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
         var base_url = "{{ url('/') }}"+'/';
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
