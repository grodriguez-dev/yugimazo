@extends('Layouts.app')

@section('content')

  <div class="container">
    <br/>
    <div class="row">
      <div class="col-md-5">
        <div class="card">
            <div class="card-header">
              @if(empty($mazo->title))
                <h1 class="h3 mb-3">Crear Mazo</h1>
              @else
              <h1 class="h3 mb-3">Editar Mazo: {{ $mazo->title }}</h1>
              @endif
                
            </div>

            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>

            <div class="card-body">

                @if(!empty($mazo->title)) 
                  @method('PUT')
                @endif

                  <div class = "form-group">
                      <label for="titulo">Titulo: </label>
                      <input type="text" required class="form-control" name="title" id="titulo" value="{{ $mazo->title ?? '' }}" placeholder="Titulo del mazo" form="verCard">
                  </div>

                  <div class="form-group ">
                    <label for="player_id">Player:</label>
                    <select type="text" class="form-control" name="player_id" form="verCard">
                      <option value="">Selecciona Un player...</option>
                        @foreach($players as $player)
                          @if(empty($mazo->title))
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                          @else
                            <option value="{{ $player->id ?? '' }}"
                            @if($player->id == $mazo->player_id)
                              selected=""
                            @endif
                            >{{ $player->name }}</option>
                          @endif      
                        @endforeach
                    </select>     
                  </div>

                  <div class="form-group ">
                    <label for="card_id">Card:</label>
                    <br>
                    <button type="submit" class="btn btn-info" form="verCard">Ver Cards</button>     
                  </div>
            </div>
        </div>
      </div>
      <form action="{{route('ver_cards.verCard')}}" method="POST" id="verCard">
        @csrf
      </form>
      <div class="col-md-7">
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Titulo</th>
                      <th>Player</th>
                      <th>Cards</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                @if (!empty($mazos))
                  @foreach($mazos as $mazo)
                    <tr>
                      <td>{{$mazo->title}}</td>
                      <td>{{$mazo->player->name}}</td>
                      <td><a href="{{route('mazos_card.card', $mazo->id)}}">{{count($mazo->cards)}}</a></td>
                      <td>
                          <form action="{{ route('mazos.destroy', $mazo->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
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
@endsection