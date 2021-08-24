@extends('layout.base')
@section('content')
    <h1>Formulaire d'enrégistrement</h1>    
    <form action="{{ route('sal.store') }}" method="post">
    @csrf
    @include('salarie._form',['btn'=>'Ajouter'])
    </form>
@endsection