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
                    @if ($demande->user_id == Auth::user()->id)
                        {{$self = "disabled"}}
                    @else
                        {{$self = ""}}
                    @endif
                    @switch($demande->decision)
                        @case("Refuse")
                            {{$col = "table-warning"}}
                            {{$btn = 'disabled' }}
                            {{$decision = "Rejetée"}}
                            @break
                        @case("Accorde")
                            {{$col = "table-success"}}
                            {{$btn = "disabled"}}
                            {{$decision = "Accordée"}}
                            @break
                        @case(null)
                            {{$col = "table-info"}}
                            {{$btn = ""}} 
                            {{$decision = "En attente"}}
                            @break
                        @default
                        
                    @endswitch
                </code>
                <tr class="{{$col}}">
                    <th scope="row">{{$demande->user->nom}}</th>
                    <th>{{$demande->typeDem}}</th>
                    <td>{{$demande->dateDeb->format('d/m/y')}}</td>
                    <td>{{$demande->duree}}</td>
                    <td>{{Str::limit($demande->objet,40)}}</td>
                    <td>
                        {{$decision}}
                    </td>
                    <td>
                        <a href="{{ route('demande.show', [$demande->id]) }}" class="btn btn-primary">Plus</a>
                        <form action="{{ route('demande.update', [$demande->id]) }}" method="POST" class="btn"
                            onsubmit="return confirm('Voulez-vous vraiment confirmer cette demande ??')">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success {{$btn}} " {{$self}}>Accepter</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center">Aucune demande n'a encore été faite</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{$demandes->links()}}
@endsection