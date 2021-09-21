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
            @case(null)
                {{$text = "Demande en attente"}}
                {{$class = "text-info"}}
            @break
            @default
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
                        <input type="text" class="form-control" name="typeDem" id="typeDem" placeholder="typeDem" readonly value="{{$demande->typeDem}}">
                        <label for="natCont">Type de demande</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="typeDem" id="typeDem" placeholder="typeDem" readonly value="{{$demande->created_at->format('i:m')}}">
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
                style="height: 132px" placeholder="objet" readonly>{{$demande->objet}}</textarea>
                <label for="objet">Objet de la demande</label>
            </div>
        </div>
        @if (Auth::user()->fonction === "admin" and $demande->decision != "Accorde")
            <form action="{{ route('demande.update', [$demande->id]) }}" method="POST">
                @csrf @method('put')
                <button type="submit" class="btn btn-success" {{$self}}>Accepter</button>
            </form>
        @endif
        <div class="{{$class}} text-center">{{$text}}</div>
    </div>
@endsection