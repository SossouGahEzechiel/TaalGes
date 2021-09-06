@extends('default')
@section('content')
    <h1>Modifier le libbellé du  service {{$service->lib}}</h1><br>
    <form action="{{ route('service.update',$service->id) }}" method="POST">
        @csrf 
        @method('PUT')
        @include('admin.service._form',['action'=>'Valider les modifications'])
    </form>
@endsection