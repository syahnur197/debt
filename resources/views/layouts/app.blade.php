<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @yield('style')
</head>
<body class="bg-white">
  <div id="app">
    @include('inc.navbar')
    <main class="@if(!Request::is('/')) py-4 @endif } pb-7">
      @if (Request::is('/'))
      <div class="jumbotron text-center jubmbotron-fluid bg-gradient-dark text-light">
        <h1>Welcome to Bruneian Debtors Repository!</h1>
        <p class="mb-0">Never let someone forgets the money they owe you!</p>
        <p>A platform for the society to remind debtors to settle their loans ASAP!</p>
        <a href="{{ url('/about') }}" class="btn btn-info">Learn More <i class="fas fa-arrow-right"></i></a>
      </div>
      @endif
      <div class="container">
        @include('inc.messages') 
        @yield('content')
      </div>
    </main>
    @include('inc.footer')
  </div>

  @yield('modals')
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('script')
</body>
</html>
