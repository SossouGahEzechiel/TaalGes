@extends('layout.base')
@section('content')
    <form action="{{ route('serv.store') }}" method="post">
        @csrf
        @include('service._form') &nbsp;
        <a href="{{ route('serv.index') }}" class="btn btn-primary">Annuler</a>
    </form>
@endsection