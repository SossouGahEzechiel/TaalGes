@extends('layout.base',['title'=>'Liste de toutes les demandes'])
@section('content')
    {{-- {{dd($dem)}} --}}
    <h1>Liste générale des demandes</h1>
    <div class="container list-group-flush">
        @forelse ($dem as $dem)
            <a href="{{ route('dem.show', [$dem]) }}" class="list-group-item list-group-item-action">
                Par {{$dem->salarie->nom}}&nbsp;le {{$dem->dateDem->format('d F Y')}}
            </a>
        @empty
            <p>Pas de demande soumise</p>
        @endforelse
    </div>
    <hr>
    <a href="{{ route('demande.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar2-plus-fill" viewBox="0 0 16 16">
            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 3.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5H2.545c-.3 0-.545.224-.545.5zm6.5 5a.5.5 0 0 0-1 0V10H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V11H10a.5.5 0 0 0 0-1H8.5V8.5z"/>
        </svg> Ajouter une nouvelle demande 
    </a>
@endsection