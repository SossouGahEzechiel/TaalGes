@extends('default')
@section('content')
    <h1>Liste des demandes</h1>
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
                <code hidden>
                    @if ($demande->decision === "Refusé")
                        {{$col = "table-light"}}
                        {{$btn = '' }}
                    @else
                        {{$col = "table-success"}}
                        {{$btn = "disabled"}}
                    @endif
                </code>
                <tr class="{{$col}}">
                    <th scope="row">{{$demande->user->nom}}</th>
                    <th>{{$demande->typeDem}}</th>
                    <td>{{$demande->dateDeb->format('d/m/y')}}</td>
                    <td>{{$demande->duree}}</td>
                    <td>{{Str::limit($demande->objet,40)}}</td>
                    <td>{{$demande->decision}}</td>
                    <td>
                        <a href="{{ route('demande.show', [$demande->id]) }}" class="btn btn-primary">Plus</a>
                        <form action="{{ route('demande.update', [$demande->id]) }}" method="POST" class="btn"
                            onsubmit="return confirm('Voulez-vous vraiment confirmer cette demande ??')">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success {{$btn}} ">Accepter</button>
                        </form>
                    </td>
                </tr>
            @empty
                <p>Vous n'avez addressé aucune demande</p>
            @endforelse
        </tbody>
    </table>
    {{$demandes->links()}}
@endsection