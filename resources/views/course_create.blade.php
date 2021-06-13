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
            <a class="nav-item nav-link" href="{{ route('courses.index') }}">Inicio</a>
        </div>
    </nav>

    <div class="container" style="margin-left: 10px;">
      <br/>
      <div class="row">
        <div class="col-md-5">
          <div class="card">
              <div class="card-header">
                @if(empty($course_e->title))
                  <h1 class="h3 mb-3">Crear Curso</h1>
                @else
                <h1 class="h3 mb-3">Editar Curso: {{ $course_e->title }}</h1>
                @endif
                  
              </div>

              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>

              <div class="card-body">

                  <form action="@if(empty($course_e->title)) {{route('courses.store')}} @else {{route('courses.update', $course_e->id)}} @endif" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @if(!empty($course_e->title)) 
                      @method('PUT')
                      <input type="hidden" name="hiddenimg" class="form-control" value="{{ $course_e->image }}" />
                    @endif

                      <div class = "form-group">
                          <label for="txtTitulo">Titulo: </label>
                          <input type="text" required class="form-control" name="title" id="txtTitulo" value="{{ $course_e->title ?? '' }}" placeholder="Titulo del curso">
                      </div>

                      <div class = "form-group">
                          <label for="txtID">Descripcion: </label>
                          <textarea required class="form-control" name="description" id="txtID" placeholder="Descripcion del curso">{{ $course_e->description ?? '' }}</textarea>
                      </div>

                      <div class = "form-group">
                          <label for="txtProfesor">Profesor: </label>
                          <input type="text" required class="form-control" name="teacher" id="txtProfesor" value="{{ $course_e->teacher ?? '' }}" placeholder="Profesor del curso">
                      </div>

                      <div class = "form-group">
                          <label for="txtSkill">Skill: </label>
                          <input type="text" required class="form-control" name="skill" id="txtSkill" value="{{ $course_e->skill ?? '' }}" placeholder="Skill del curso">
                      </div>

                      <div class = "form-group">
                          <label for="txtPlataforma">Plataforma: </label>
                          <input type="text" required class="form-control" name="platform" id="txtPlataforma" value="{{ $course_e->platform ?? '' }}" placeholder="Donde viste el curso">
                      </div>

                      <div class = "form-group">
                          <label for="txtDuracion">Duracion: </label>
                          <input type="text" required class="form-control" name="duration" id="txtDuracion" value="{{ $course_e->duration ?? '' }}" placeholder="Duracion el curso">
                      </div>

                      <div class = "form-group">
                          <label for="txtRepositorio">Repositorio: </label>
                          <input type="text" class="form-control" name="repository" id="txtRepositorio" value="{{ $course_e->repository ?? '' }}" placeholder="Repositorio del curso">
                      </div>

                      <div class = "form-group">
                          <label for="txtImg">Imagen: </label>
                          @if(!empty($course_e->image))
                            <img class="img-thumbnail rounded" src="{{asset('assets/img/'.$course_e->image)}}" width="50">
                          @endif
                          <br/>
                          <input type="file" name="image">
                      </div>
                      
                      <div class="btn-group" role="group" aria-label="">
                        @if(!empty($course_e->title))
                          <button type="submit" class="btn btn-warning">Editar</button>
                        @else
                          <button type="submit" class="btn btn-success">Agregar</button>
                        @endif
                          
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <div class="col-md-7">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Profesor</th>
                        <th>Skill</th>
                        <th>Plataforma</th>
                        <th>Duracion</th>
                        <th>Repositorio</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                  @if (!empty($courses))
                    @foreach($courses as $course)
                      <tr>
                        <td>{{$course->title}}</td>
                        <td>{{$course->description}}</td>
                        <td>{{$course->teacher}}</td>
                        <td>{{$course->skill}}</td>
                        <td>{{$course->platform}}</td>
                        <td>{{$course->duration}}</td>
                        <td>{{$course->repository}}</td>
                        <td>
                            <img class="img-thumbnail rounded" src="{{asset('assets/img/'.$course->image)}}" width="50">
                        </td>
                        <td>
                          <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">Editar</a>
                          <a href="" class="btn btn-danger" onclick="event.preventDefault(); deleteForm('delete-{{$course->id}}')">Borrar</a>
                            <form style="display: none;" action="{{ route('courses.destroy', $course->id) }}" id="delete-{{$course->id}}" method="POST">
                              @csrf
                              @method('DELETE')
                            </form>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
            </table>
        </div>
      </div>
    </div>
    <script>
        function deleteForm(name) {
          let form = document.getElementById(name);
          form.submit();
        }
    </script>
  </body>
</html>