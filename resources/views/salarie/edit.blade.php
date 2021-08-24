@extends('layout.base')
@section('content')
    <h1>Formulaire de mise à jour</h1>
    <form action="{{ route('sal.update', $sal->id) }}" method="post">
        @csrf
        @method('put')
        @include('salarie._form',['btn'=>'Modifier'])
    </form>
@endsection