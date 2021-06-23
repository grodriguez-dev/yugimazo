@extends('Layouts.app')

@section('content')

  <div class="card"> 
    <div class="card-header">
      <h1>Cards</h1>
    </div>

      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>

    <div class="card-body">
       <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Skill</th>
                  <th>Type</th>
                  <th>Atk</th>
                  <th>Def</th>
                  <th>Image</th>
              </tr>
          </thead>
          <tbody>
            @foreach($cards as $ca)
              <tr>
                <td>{{$ca->name}}</td>
                <td>{{$ca->skill}}</td>
                <td>{{$ca->type}}</td>
                <td>{{$ca->atk}}</td>
                <td>{{$ca->def}}</td>
                <td>
                    <img class="img-thumbnail rounded" src="{{asset('assets/cards/'.$ca->image)}}" width="100">
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <a href="{{route('mazos.index')}}" class="btn btn-secondary">Volver</a>
    </div>
  </div>
@endsection