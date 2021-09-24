@extends('default')
@section('content')
    <code hidden>
        @switch($demande->decision)
            @case("Accorde")
                {{$text = "Demande déjà acceptée"}}
                {{$class = "text-success"}}
                @break
            @case("Refuse")
                {{$text = "Demande rejetée"}}
                {{$class = "text-danger"}}
                @break
            @case(null)
                {{$text = "Demande en attente"}}
                {{$class = "text-info"}}
            @break
        @endswitch
        @if ($demande->user_id == Auth::user()->id)
            {{$self = "disabled"}}
        @else
            {{$self = ""}}
        @endif
    </code>
    <h1>Demande de {{$demande->user->nom}} {{$demande->user->prenom}}</h1>
    <div class=" col-8 container">
        <div class="mb-3">
            <div class="row">
                <!-- Type de demande -->
                <div class="col-8">

                    <div class="form-floating">
                        <input type="text" class="form-control" name="typeDem" id="typeDem" placeholder="typeDem" disabled value="{{$demande->typeDem}}">
                        <label for="natCont">Type de demande</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="typeDem" id="typeDem" placeholder="typeDem" readonly value="{{$demande->created_at->format('d/m/y')}}">
                        <label for="natCont">Date de soumission</label>
                    </div>
                </div>
            </div>
            <div class="row gx-6 mt-3">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="dateDeb" id="dateDeb" value="{{$demande->dateDeb->format('d/m/y')}}" readonly>
                        <label for="dateDeb">Date de début</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control name="duree" id="duree" value="{{old('duree') ?? $demande->duree}}" readonly>
                        <label for="duree">Durée de la permission</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="dateFin" id="dateFin" value="{{($demande->dateDeb->addDays($demande->duree))->locale('fr')->calendar() }}" readonly>
                        <label for="dateFin">Date de fin</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="form-floating mb-3">
                <textarea class="form-control" name="objet"  id="objet"  
                style="height: 132px" placeholder="objet" disabled>{{$demande->objet}}</textarea>
                <label for="objet">Objet de la demande</label>
            </div>
        </div>
        @if (Auth::user()->fonction === "admin" and $demande->decision == null)
            <div class="row mb-3">
                <div class="col-3">
                    <button onclick="return document.getElementById('accepter').style.display = 'block';" class="btn btn-outline-success" {{$self}}>Accepter</button>
                </div>
                <div class="col-auto mx-auto">
                    <button onclick="return document.getElementById('accepter&dec').style.display = 'block';" class="btn btn-outline-primary" {{$self}}>Accepter et déduire</button>
                </div>
                <div class="col-auto">
                    <button onclick="return document.getElementById('rejeter').style.display = 'block';" class="btn btn-outline-danger" {{$self}}>Rejeter</button>
                </div>
            </div>
        @else
            <code hidden>{{$v_by = $demande->v_by()}}</code>
            <div class="text-center {{$class}}" style="font-style: italic; font-weight: bold">Décision prise par : {{$v_by->nom}} du département des {{$v_by->service->lib}}
                {{-- @dd($demande->v_at->locale('fr')->calendar()) --}}
                ({{$demande->v_at->locale('fr')->calendar()}})
            </div>
        @endif
        <div class="{{$class}} text-center">{{$text}}</div>
    </div>

    {{-- Simple validation --}}
    <div class="modal fade show" id="accepter" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" style="padding-right: 17px; display:;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body text-danger" style="text-align: center; font-size: 2em">Voulez-vous vraiment accepter cette demande ?</div>
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
    
    {{-- Validation avec déduction --}}
    <div class="modal fade show" id="accepter&dec" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" style="padding-right: 17px; display:;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body text-danger" style="text-align: center; font-size: 2ex">Voulez-vous vraiment accepter cette demande ? Elle sera appliquée avec une dédution de {{$demande->duree}} jour(s)</div>
          <p style="padding-right: 45%""></p>
          <div class="modal-footer">
            <a class="btn btn-info col-auto " onclick="return document.getElementById('accepter&dec').style.display = 'none';" type="button" data-dismiss="modal" >Annuler</a>
            <form action="{{ route('demande.validation', [$demande->id,true,true]) }}" method="POST" class="btn">
              @csrf
              @method('put')
              <button type="submit" class="btn btn-primary">Accepter et déduire</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    {{-- Rejet d'une demande --}}
    <div class="modal fade show" id="rejeter" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" style="padding-right: 17px; display:;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body text-danger" style="text-align: center; font-size: 2ex">Voulez-vous vraiment rejeter cette demande ? Elle ne pourra plus être acceptée</div>
          <p style="padding-right: 45%""></p>
          <div class="modal-footer">
            <a class="btn btn-info col-auto " onclick = " return document.getElementById('rejeter').style.display = 'none';" type="button" data-dismiss="modal" >Annuler</a>
            <form action="{{ route('demande.validation', [$demande->id,false]) }}" method="POST" class="btn">
              @csrf
              @method('put')
              <button type="submit" class="btn btn-danger">Rejeter</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection