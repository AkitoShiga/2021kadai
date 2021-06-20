<! docutype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>
  <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
  <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
  <div id="app">test</div>
</body>
</html>
