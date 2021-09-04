@extends('layout.base')
@section('content')
    <h1>Modifier  la demande courant</h1>
    <form action="{{ route('dem.update', [$dem->id]) }}" method="post">
        @csrf
        @method('put')
        @include('demande._form')
    </form>
@endsection