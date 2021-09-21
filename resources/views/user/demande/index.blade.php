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
                @if ($demande->decision === "Refusé")
                    {{$col = "table-secondary"}}
                @else
                    {{$col = "table-success"}}
                @endif
                <?php $fin = array(
                        'jour' => $demande->dateDeb->format('d')+$demande->duree,
                        'mois' => $demande->dateDeb->format('m'),
                        'annee' => $demande->dateDeb->format('y'),
                    );   
                    if ($fin['jour']> 30) {
                        $fin['jour'] =01;
                        $fin['mois'] +=1;               
                    }
                    if ($fin['mois']> 12) {
                        $fin['mois'] =01;
                        $fin['annee'] +=1;               
                    }
                ?>
                    @if ($demande->user_id == Auth::user()->id)
                        {{$self = "disabled"}}
                    @else
                        {{$self = ""}}
                    @endif
                    @switch($demande->decision)
                        @case("Refusé")
                            {{$col = "table-light"}}
                            {{$btn = '' }}
                            {{$decision = 'Refusée'}}
                            @break
                        @case("Accordé")
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
                    <td>{{$fin['jour']}}/{{$fin['mois']}}/{{$fin['annee']}}</td>
                    <td>{{$demande->duree}}</td>
                    <td>{{$demande->objet}}</td>
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