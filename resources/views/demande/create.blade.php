@extends('layout.base')
@section('content')
    <h1>Formulaire pour une nouvelle demande</h1>
    <form action="{{ route('demande.store') }}" method="POST">
        @csrf
        @include('demande._f!orm')
    </form>
@endsection