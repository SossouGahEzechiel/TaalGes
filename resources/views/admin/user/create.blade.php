@extends('admin.default')
@section('content')
    @foreach ($errors->all() as $message)
        {{ $message }}
    @endforeach
    <h1 style="text-align: center">Formulaire d'enrégistrement</h1>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        @include('admin.user._form',['nat'=>"Valider l'enrégistrement"])
    </form>
@endsection