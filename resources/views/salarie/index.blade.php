@extends('layout.base')
@section('content')
    <h1>Liste des Salariers</h1>
    <div class="list-group-flush">
        @forelse ($sal as $salarie)
            <a href="{{ route('sal.show', $salarie->id) }}"" class="list-group-item list-group-item-light">{{$salarie->nom}} {{$salarie->prenom}}</a> 
        @empty
            <p>Pas de salarié dans la base de données</p>
        @endforelse
    </div>
    {{$sal->links()}}
    <hr>
    <a href="{{ route('sal.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
        </svg> 
        Ajouter un nouveau salarier
    </a>
    
@endsection