@extends('layout.base')
@section('content')
    <form action="{{ route('serv.update', [$serv->id]) }}" method="POST">
        @csrf
        @method('put')
        @include('service._form') &nbsp;
        <a href="{{ route('serv.show', $serv) }}" class="btn btn-primary">Annuler</a>
    </form>
    
@endsection