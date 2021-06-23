<!doctype html>
<html lang="en">
  <head>
    <title>Yugi-oh!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="jquery.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <img width="40" src="{{asset('gr-logo.png')}}" />
            <a class="nav-item nav-link" href="{{ route('players.index') }}">Players</a>
            <a class="nav-item nav-link" href="{{ route('cards.index') }}">Cards</a>
            <a class="nav-item nav-link" href="{{ route('mazos.index') }}">Mazos</a>
        </div>
    </nav>
    <br>
    <div class="container">
      <div class="text-center">
        @yield('content')
      </div>
    </div>
  </body>
</html>