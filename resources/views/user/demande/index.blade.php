@extends('default')

@section('content')
    <h1>Mes demandes</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Type</th>
            <th scope="col">début</th>
            <th scope="col">durée</th>
            <th scope="col">fin</th>
            <th scope="col">objet</th>
            <th scope="col">Etat</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>         
            @forelse ($demandes as $demande)
            <code hidden>
                @switch($demande->decision)
                    @case("Refuse")
                        {{$col = "table-light"}}
                        {{$btn = '' }}
                        {{$decision = 'Refusée'}}
                        @break
                    @case("Accorde")
                        {{$col = "table-success"}}
                        {{$btn = "disabled"}}
                        {{$decision = 'Accordée'}}
                        @break
                    @case(null)
                        {{$col = "table-info"}}
                        {{$btn = ""}}
                        {{$decision = 'En attente'}} 
                        @break
                    @default
                    
                @endswitch
            </code>
                <tr class="{{$col}}">
                    <th scope="row">{{$demande->typeDem}}</th>
                    <td>{{$demande->dateDeb->format('d/m/y')}}</td>
                    <td>{{$demande->duree}}</td>
                    <td>{{($demande->dateDeb->addDays($demande->duree))->format('d/m/y')}}</td>
                    <td>{{Str::limit($demande->objet,25)}}</td>
                    <td>{{$decision}}</td>
                    <td><a href="{{ route('demande.show', [$demande->id]) }}" class="btn btn-primary">Détails</a></td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align: center">Vous n'avez addressé aucune demande</td></tr>
            @endforelse
        </tbody>
    </table>
    {{$demandes->links()}}
@endsection