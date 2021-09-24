@extends('default')
@section('content')
<code hidden>
    @switch(url()->current())
        @case(route('byTime.today'))
            {{$title = "Liste des demandes de la journée "}}
            {{$total = $total." au total"}}
            @break
        @case(route('byTime.week'))
            {{$title = "Liste des demandes de la semaine"}}
            {{$total = $total." au total"}}
            @break
        @case(route('byTime.month'))
            {{$title = "Liste des demandes de ce mois "}}
            {{$total = $total." au total"}}
            @break
        @default
    @endswitch
</code>
    <h2>{{$title}}</h2><h6>{{$total}}</h6>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Auteur</th>
                <th scope="col">Type</th>
                <th scope="col">début</th>
                <th scope="col">durée</th>
                <th scope="col">objet</th>
                <th scope="col">Etat</th>
                <th scope="col">Decision</th>
            </tr>
        </thead>
        <tbody>         
            @forelse ($demandes as $demande)
               <code hidden>
                    @switch($demande->decision)
                        @case(null)
                            {{$decision = 'En attente'}}
                            {{$col = "table-info"}}
                            {{$btn = '' }}
                            @break
                        @case('Accorde')
                            {{$decision = 'Accordée'}}
                            {{$col = "table-success"}}
                            {{$btn = 'disabled' }}
                            @break
                        @case('Refuse')
                            {{$decision = 'Non accordée'}}
                            {{$col = "table-light"}}
                            {{$btn = 'disabled' }}
                            @break                                
                    @endswitch
               </code>
                <tr class="{{$col}}">
                    <th scope="row">{{$demande->user->nom}}</th>
                    <th>{{$demande->typeDem}}</th>
                    <td>{{$demande->dateDeb->format('d/m/y')}}</td>
                    <td>{{$demande->duree}}</td>
                    <td>{{Str::limit($demande->objet,25)}}</td>
                    <td>
                        {{$decision}}
                    </td>
                    <td>
                        <a href="{{ route('demande.show', [$demande->id]) }}" class="btn btn-primary">Plus</a>                       
                        @if($demande->user_id == Auth::user()->id)
                            <button onclick="return document.getElementById('accepter').style.display = 'block';" class="btn btn-success {{$btn}} disabled">Accepter</button> 
                        @else
                            <button onclick="return document.getElementById('accepter').style.display = 'block';" class="btn btn-success {{$btn}}">Accepter</button>
                        @endif
                        </td>
                </tr>
            @empty
                <tr class="alert alert-warning">
                    <td colspan="7" style="text-align: center">Aucune demande ne correspond à ce critére</td>
                </tr>
            @endforelse
        </tbody>
    </table>
     {{-- Simple validation --}}
     <div class="modal fade show" id="accepter" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" style="padding-right: 17px; display:; font-size: 2mm">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body text-danger" style="text-align: center; font-size: 2em">Voulez-vous vraiment accepter cette demande ? <br> <strong>Elle sera sans déduction !!</strong></div>
            <p style="padding-right: 45%""></p>
            <div class="modal-footer">
              <a class="btn btn-info col-auto " onclick="return document.getElementById('accepter').style.display = 'none';" type="button" data-dismiss="modal" >Annuler</a>
              <form action="{{ route('demande.validation', [$demande->id,true]) }}" method="POST" class="btn">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-success">Accepter</button>
              </form>
            </div>
          </div>
        </div>
    </div>
@endsection