<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    @viteReactRefresh
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>   
    @include('auth.login') 
</body>
</html>
