@extends('admin.default')
@section('content')
<h1>Ajouter un nouveau service</h1><br>
    <form action="{{ route('service.store') }}" method="POST">
        @csrf
        @include('admin.service._form',['action'=>'Ajouter comme nouveau service'])
    </form>
@endsection