@extends('Layouts.app')

@section('content')

<h1>Players list</h1>
<a href="{{ route('players.create') }}" class="btn btn-primary">Create Player</a>
<br><br>
  <table class="table table-bordered">
      <thead>
          <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Image</th>
              <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach($players as $player)
          <tr>
            <td>{{$player->name}}</td>
            <td style="width: 500px;">{{$player->description}}</td>
            <td>
                <img class="img-thumbnail rounded" src="{{asset('assets/players/'.$player->image)}}" width="100">
            </td>
            <td>
              <a href="{{ route('players.show', $player->id) }}" class="btn btn-info">Ver</a>
              
                <form action="{{ route('players.destroy', $player->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </td>
          </tr>
        @endforeach
      </tbody>
  </table>
@endsection