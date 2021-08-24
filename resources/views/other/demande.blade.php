@extends('other.layout.obase')
@section('content')
    @forelse ($tDem as $tDem)
        <p> {{$tDem->libTypeDmde}} </p>
    @empty
        
    @endforelse
@endsection