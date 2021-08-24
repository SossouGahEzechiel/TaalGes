@extends('layout.base')
@section('content')
<h1>Ajouter une nouvelle fonction</h1>
    <form action="{{ route('fonc.store') }}" method="post">
        @csrf
        @include('fonction._form',['btn'=>'Ajouter'])
    </form>
@endsection