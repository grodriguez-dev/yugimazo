<!doctype html>
<html lang="en">
  <head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <img width="40" src="{{asset('gr-logo.png')}}" />
            <a class="nav-item nav-link" href="{{ route('courses.create') }}">Crear Curso</a>

        </div>
    </nav>
    <div class="jumbotron text-center">
        <h1 class="display-3">Bienvenidos a mi lista de cursos realizados</h1>
        <p class="lead">Aqui podras ver todos los cursos que he realizado a lo largo de mi carrera como programador</p>
    </div>
    <div class="container">
    <br/>
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4">
                    <div class="card text-center">
                       <div class="card-group">
                          <div class="card">
                            <img class="card-img-top" src="{{asset('assets/img/'.$course->image)}}" alt="">
                            <div class="card-body" style="background: darkgray;">
                                <h2 class="card-title">{{$course->title}}</h2>
                                <p >{{$course->description}}</p>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="card-title">{{$course->teacher}}</h6>
                                    </div> &#47;
                                    <div class="col-md-5">
                                        <h6 class="card-title">{{$course->skill}}</h6>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h6 class="card-title">{{$course->platform}}</h6>
                                    </div> &#47;
                                    <div class="col-md-4">
                                        <h6 class="card-title">{{$course->duration}}</h6>
                                    </div>
                                </div>
                                <a href="{{$course['repositorio']}}" class="btn btn-light">Ver Repositorio</a>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br>
  </body>
</html>