@extends('default')
@section('content')
    <code hidden>
        @switch(url()->current())
        @case(route('demande.accorde'))
            {{$col = "table-success"}}
            {{$btn = 'disabled' }}
            {{$title = "Liste des demandes accordées"}}
            @break
        @case(route('demande.refuse'))
            {{$col = "table-light"}}
            {{$btn = 'disabled' }}
            {{$title = "Liste des demandes non-accordées"}}
            @break
        @case(route('demande.attente'))
            {{$col = "table-info"}}
            {{$btn = '' }}
            {{$title = "Liste des demandes en attente"}}
            @break
        @default
    @endswitch
    </code>
    <h1>{{$title}}</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Auteur</th>
                <th scope="col">Type</th>
                <th scope="col">début</th>
                <th scope="col">durée</th>
                {{-- <th scope="col">fin</th> --}}
                <th scope="col">objet</th>
                <th scope="col">Etat</th>
                <th scope="col">Decision</th>
            </tr>
        </thead>
        <tbody>         
            @forelse ($demandes as $demande)
                
                <tr class="{{$col}}">
                    <th scope="row">{{$demande->user->nom}}</th>
                    <th>{{$demande->typeDem}}</th>
                    <td>{{$demande->dateDeb->format('d/m/y')}}</td>
                    <td>{{$demande->duree}}</td>
                    <td>{{Str::limit($demande->objet,25)}}</td>
                    <td>
                        @switch($demande->decision)
                            @case(null)
                                {{$decision = 'En attente'}}
                                @break
                            @case('Accorde')
                                {{$decision = 'Accordée'}}
                                @break
                            @case('Refuse')
                                {{$decision = 'Non accordée'}}
                                @break
                                
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('demande.show', [$demande->id]) }}" class="btn btn-primary">Plus</a>
                        <form action="{{ route('demande.update', [$demande->id]) }}" method="POST" class="btn"
                            onsubmit="return confirm('Voulez-vous vraiment confirmer cette demande ??')">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success {{$btn}}">Accepter</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="alert alert-warning">
                    <td colspan="7" style="text-align: center">Aucune demande ne correspond à ce critére</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{$demandes->links()}}
@endsection