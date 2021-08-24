@extends('layout.base')
@section('content')
    <h1>Formulaire de mise à jour</h1> 
    <form action="{{ route('fonc.update', $fonc->id) }}" method="post">
        @csrf
        @method('put')
        @include('fonction._form',['btn'=>'Modifier'])
    </form>
@endsection