@extends('default')
@section('content')
    {{-- <h1>{{Auth::user()->nom}}&nbsp;{{Auth::user()->prenom}}</h1> --}}
    <h1>Formuaire de demande</h1>
    <form action="{{ route('demande.store') }}" method="POST">
        @csrf
        <div class="col-8 mx-auto">
            <div class="row-auto">
                <!-- Type de dzmande -->
                <div class="form-floating">
                    <select class="form-select @error('typeDem') is-invalid @enderror " id="typeDem" name="typeDem" aria-label="Floating label select example">
                        <option value="1">Congé</option>
                        <option value="2">Permission</option>
                    </select>
                    <label for="natCont">Type de demande</label>
                </div>
            </div>
            <div class="row gx-6 mt-3">
                <div class="col">
                    <div class="form-floating">
                        <input type="date" class="form-control @error('dateDeb') is-invalid @enderror" name="dateDeb" id="dateDeb" value="{{old('dateDeb') ?? $demande->dateDeb}}" >
                        <label for="dateDeb">Date de début</label>
                    </div>
                    @error('dateDeb')
                        <div class="alert alert-warning">{{$message}}</div>
                    @enderror
                </div>
                <div class="col">
                    <div class="form-floating">
                        <input type="number" class="form-control @error('duree') is-invalid @enderror" name="duree" id="duree" value="{{old('duree') ?? $demande->duree}}" min="1" max="30" >
                        <label for="duree">Durée de la permission</label>
                        @error('duree')
                            <div class="alert alert-warning">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="form-floating mb-3">
                    <textarea class="form-control @error('objet') is-invalid @enderror" name="objet"  id="objet" minlength="3" maxlength="128"
                    style="height: 132px" placeholder="objet" required>{{old('objet')}}</textarea>
                    <label for="objet">&nbsp;&nbsp;&nbsp;Objet de la demande</label>
                </div>
                @error('objet')
                    <div class="alert alert-warning">{{$message}}</div>
                @enderror
            </div>
        </div> 
        <div class="d-grid gap-2 col-3 mx-auto mt-1">
            <button type="submit" class="btn btn-success">Valider</button>
        </div>
    </form>
@endsection