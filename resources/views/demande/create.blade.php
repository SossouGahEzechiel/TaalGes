@extends('layout.base')
@section('content')
    <h1>Formulaire pour une nouvelle demande</h1>
{{-- <script>
    function onvavoir() {
        
        alert('ijdif');
        return document.getElementsByName('tear'). = 'disabled';
    }
</script> --}}
    <form action="{{ route('dem.store') }}" method="POST">
        @csrf
        @include('demande._form')
    </form>
@endsection