@extends('other.layout.obase')
@section('content')
    <h1>liste des congés</h1>
    <div class="list-group-flush">
        @forelse ($conges as $conge)
            @if ($conge->etatConge == "refusé")
                <a href="{{ route('other.show',$conge) }}" class="list-group-item list-group-item-action list-group-item-warning">{{$conge->etatConge}}</a>
            @else
                <a href="{{ route('other.show',$conge->id) }}" class="list-group-item list-group-item-action list-group-item-success">{{$conge->etatConge}}</a>
            @endif
        @empty
            <p>Pas de demande dans la base de données</p>
        @endforelse
    </div>
@endsection