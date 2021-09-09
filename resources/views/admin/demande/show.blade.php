@extends('default')
@section('content')
    <code hidden>
        <?php $fin = array(
                'jour' => $demande->dateDeb->format('d')+$demande->duree,
                'mois' => $demande->dateDeb->format('m'),
                'annee' => $demande->dateDeb->format('y'),
            );   
            if ($fin['jour']> 30) {
                $fin['jour'] =1;
                $fin['mois'] +=1;               
            }
            if ($fin['mois']> 12) {
                $fin['mois'] =01;
                $fin['annee'] +=1;               
            }
        ?>
    </code>
    <h1>Demande de {{$demande->user->nom}} {{$demande->user->prenom}}</h1>
    <div class="d-grid grid-cols-8 ">
        <div class="col-8 ">
            <div class="row-auto">
                <!-- Type de dzmande -->
                <div class="form-floating">
                    <select class="form-select @error('typeDem') is-invalid @enderror " id="typeDem" name="typeDem" aria-label="Floating label select example" disabled>
                        <option value="congé">Congé</option>
                        <option value="permission">Permission</option>
                    </select>
                    <label for="natCont">Type de demande</label>
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
                        <input type="text" class="form-control" name="dateFin" id="dateFin" value="{{$fin['jour']}}/{{$fin['mois']}}/{{$fin['annee']}}" readonly>
                        <label for="dateFin">Date de fin</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8 mt-3">
            <div class="form-floating mb-3">
                <textarea class="form-control" name="objet"  id="objet"  
                style="height: 132px" placeholder="objet" readonly>{{$demande->objet}}</textarea>
                <label for="objet">Objet de la demande</label>
            </div>
        </div>
        @if (Auth::user()->fonction === "admin")
            <form action="{{ route('demande.update', [$demande->id]) }}" method="POST">
                @csrf @method('put')
                <button type="submit" class="btn btn-success">Accepter</button>
            </form>
        @endif
    </div>
@endsection