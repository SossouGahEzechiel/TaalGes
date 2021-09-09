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
                </code>
                <tr class="{{$col}}">
                    <th scope="row">{{$demande->typeDem}}</th>
                    <td>{{$demande->dateDeb->format('d/m/y')}}</td>
                    <td>{{$fin['jour']}}/{{$fin['mois']}}/{{$fin['annee']}}</td>
                    <td>{{$demande->duree}}</td>
                    <td>{{$demande->objet}}</td>
                    <td>{{$demande->decision}}</td>
                </tr>
            @empty
                <p>Vous n'avez addressé aucune demande</p>
            @endforelse
        </tbody>
    </table>
@endsection