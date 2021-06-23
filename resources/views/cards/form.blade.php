@extends('layouts.app')

@section('content')
  
  <div class="card">
      <div class="card-header">
        @if(empty($card->name))
          <h1 class="h3 mb-3">Crear Card</h1>
        @else
        <h1 class="h3 mb-3">Editar Card: {{$card->name}}</h1>
        @endif
          
      </div>

      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>

      <div class="card-body">

          <form action="@if(empty($card->name)) {{route('cards.store')}} @else {{route('cards.update', $card->id)}} @endif" method="POST" enctype="multipart/form-data" >
            @csrf
            @if(!empty($card->name)) 
              @method('PUT')
              <input type="hidden" name="hiddenimg" class="form-control" value="{{ $card->image }}" />
            @endif

               <div class = "form-group">
                  @if(empty($card->name)) 
                    <img id="output"/ style="width: 200px;">
                  @else
                    <img id="output"/ src="{{asset('assets/cards/'.$card->image)}}" style="width: 200px;">
                  @endif
                  <br>
                  <input type="file" accept="assets/cards/*" onchange="loadFile(event)" name="image" required="">           
              </div>
              
              <div class = "form-group">
                  <label for="name">Name: </label>
                  <input type="text" required class="form-control" name="name" id="name" value="{{ $card->name ?? '' }}" placeholder="Nombre del monstruo">
              </div>

              <div class = "form-group">
                  <label for="skill">Skill: </label>
                  <textarea required class="form-control" name="skill" id="skill" placeholder="Skill del monstruo">{{ $card->skill ?? '' }}</textarea>
              </div>

              @php 

                    $select1 = '';
                    $select2 = '';
                    $select3 = '';
                if(!empty($card->type)){
                  switch ($card->type) {
                      case 'monstruo':
                          $select1 = 'selected=""';
                          $select2 = '';
                          $select3 = '';
                          break;
                      case 'trampa':
                          $select1 = '';
                          $select2 = 'selected=""';
                          $select3 = '';
                          break;
                      case 'magica':
                          $select1 = '';
                          $select2 = '';
                          $select3 = 'selected=""';
                          break;
                  }
                }
              @endphp

              <div class = "form-group">
                  <label for="type">Type: </label>
                  <select type="text" class="form-control" name="type">
                    <option value="">Selecciona Un tipo...</option>       
                    <option value="monstruo" {{$select1}}>Monstruo</option>
                    <option value="trampa" {{$select2}}>Trampa</option>
                    <option value="magica" {{$select3}}>Magia</option>
                  </select>     
              </div>

              <div class = "form-group">
                  <label for="atk">Atk: </label>
                  <input type="number" class="form-control" name="atk" id="atk" value="{{ $card->atk ?? '' }}" placeholder="Puntos de ataque del monstruo">
              </div>

              <div class = "form-group">
                  <label for="def">Def: </label>
                  <input type="number" class="form-control" name="def" id="def" value="{{ $card->def ?? '' }}" placeholder="Puntos de defensa del monstruo">
              </div>

              <div class="btn-group" role="group" aria-label="" style="width: 100%;">
                @if(!empty($card->name))
                  <button type="submit" class="btn btn-warning">Editar</button>
                  <a href="{{ route('cards.create') }}" class="btn btn-danger">Cancelar</a>
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
