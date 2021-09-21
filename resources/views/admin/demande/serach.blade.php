@extends('default')
@section('content')
    {{-- @dd({{ route('demande.accorde')) }}) --}}
    @if (url()->previous()==route('demande.accorde'))
        <h2>Liste des demandes accordées aux salariés correspondant à "{{$request->search}}"</h2>
    @endif
    
    @if (url()->previous()==route('demande.refuse'))
        <h2>Liste des demandes non-accordées aux salariés correspondant à "{{$request->search}}"</h2>
    @endif
    
    @if (url()->previous()==route('demande.attente'))
        <h2>Liste des demandes en attentes des salariés correspondant à "{{$request->search}}"</h2>
    @endif
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

                    <code hidden>
                    @if ($demande->user_id == Auth::user()->id)
                        {{$self = "disabled"}}
                    @else
                        {{$self = ""}}
                    @endif
                    @switch($demande->decision)
                        @case("Refusé")
                            {{$col = "table-light"}}
                            {{$btn = '' }}
                            {{$decision = "Refusée"}}
                            @break
                        @case("Accordé")
                            {{$col = "table-success"}}
                            {{$btn = "disabled"}}
                            {{$decision = "Accordée"}}
                            @break
                        @case(null)
                            {{$col = "table-info"}}
                            {{$btn = ""}} 
                            {{$decision = "En attente"}}
                            @break
                    @endswitch
                </code>
                </code>
                <tr class="{{$col}}">
                    <th scope="row">{{$demande->user->nom}}</th>
                    <th>{{$demande->typeDem}}</th>
                    <td>{{$demande->dateDeb->format('d/m/y')}}</td>
                    <td>{{$demande->duree}}</td>
                    <td>{{Str::limit($demande->objet,40)}}</td>
                    <td>{{$decision}}</td>
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
                <tr>
                    <td colspan="7" style="text-align: center" class="alert alert-danger">Aucun résultat ne correspont à votre critère de recherche</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{-- {{$demandes->links()}} --}}
@endsection