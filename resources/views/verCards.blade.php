@extends('Layouts.app')

@section('content')

  <div class="card"> 
    <div class="card-header">
      <h1>Select Cards</h1>
    </div>

      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>

    <div class="card-body">
      <form method="POST" action="{{route('saved_cards.savedCard')}}">
        @csrf
       <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Skill</th>
                  <th>Type</th>
                  <th>Atk</th>
                  <th>Def</th>
                  <th>Image</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach($cards as $card)
              <tr>
                <td>{{$card->name}}</td>
                <td>{{$card->skill}}</td>
                <td>{{$card->type}}</td>
                <td>{{$card->atk}}</td>
                <td>{{$card->def}}</td>
                <td>
                    <img class="img-thumbnail rounded" src="{{asset('assets/cards/'.$card->image)}}" width="100">
                </td>
                <td>
                  <input type="checkbox" class="check_id" name="check_id[]" value="{{$card->id}}">
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <input type="hidden" name="title" value="{{$title}}">
        <input type="hidden" name="player_id" value="{{$player_id}}">
        <button type="submit" class="btn btn-secondary">Agregar</button>
      </form>
    </div>
  </div>
@endsection