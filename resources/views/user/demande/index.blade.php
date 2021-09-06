@extends('default')
@section('content')
    @forelse ($demandes as $demande)
        <p>{{$demande->objet}}</p>
    @empty
        <p>Vous n'avez addressé aucune demande</p>
    @endforelse
@endsection