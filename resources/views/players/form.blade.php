@extends('layouts.app')

@section('content')
  
  <div class="card">
      <div class="card-header">
        @if(empty($player->name))
          <h1 class="h3 mb-3">Crear Player</h1>
        @else
        <h1 class="h3 mb-3">Editar player: {{$player->name}}</h1>
        @endif
          
      </div>

      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>

      <div class="card-body">

          <form action="@if(empty($player->name)) {{route('players.store')}} @else {{route('players.update', $player->id)}} @endif" method="POST" enctype="multipart/form-data" >
            @csrf
            @if(!empty($player->name)) 
              @method('PUT')
              <input type="hidden" name="hiddenimg" class="form-control" value="{{ $player->image }}" />
            @endif

               <div class = "form-group">
                  @if(empty($player->name)) 
                    <img id="output"/ style="width: 200px;">
                  @else
                    <img id="output"/ src="{{asset('assets/players/'.$player->image)}}" style="width: 200px;">
                  @endif
                  <br>
                  <input type="file" accept="assets/players/*" onchange="loadFile(event)" name="image" required="">           
              </div>
              
              <div class = "form-group">
                  <label for="name">Name: </label>
                  <input type="text" required class="form-control" name="name" id="name" value="{{ $player->name ?? '' }}" placeholder="Nombre del jugador">
              </div>

              <div class = "form-group">
                  <label for="description">Description: </label>
                  <textarea required class="form-control" name="description" id="description" placeholder="Descripcion del jugador">{{ $player->description ?? '' }}</textarea>
              </div>

              <div class="btn-group" role="group" aria-label="" style="width: 100%;">
                @if(!empty($player->name))
                  <button type="submit" class="btn btn-warning">Editar</button>
                  <a href="{{ route('players.create') }}" class="btn btn-danger">Cancelar</a>
                @else
                  <button type="submit" class="btn btn-success">Agregar</button>
                @endif
                  
              </div>
          </form>
      </div>
  </div>
  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };
  </script>
@endsection
