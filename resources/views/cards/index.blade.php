@extends('Layouts.app')

@section('content')

<h1>Cards list</h1>
<a href="{{ route('cards.create') }}" class="btn btn-primary">Create Player</a>
<br><br>
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
            @if(($card->type === 'magica') || ($card->type === 'trampa'))
              <td>--</td>
              <td>--</td>
            @else
              <td>{{$card->atk}}</td>
              <td>{{$card->def}}</td>
            @endif
            <td>
                <img class="img-thumbnail rounded" src="{{asset('assets/cards/'.$card->image)}}" width="100">
            </td>
            <td>
              <a href="{{ route('cards.show', $card->id) }}" class="btn btn-info">Ver</a>
              
                <form action="{{ route('cards.destroy', $card->id) }}" method="POST">
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