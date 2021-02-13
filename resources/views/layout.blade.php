<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <script>window.Laravel = { csrfToken: '{{csrf_token()}}' }</script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        
        <div id="app">
        @yield('content')
        </div>
        
        <script src="{{ asset('js/app.js') }}" defer></script>  
        <script src="https://kit.fontawesome.com/4bbb366569.js"></script>
    </body>
</html>
