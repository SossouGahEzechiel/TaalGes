@extends('default')
<code hidden>
    @if ($user->sexe = 'M')
        {{$sexe = "Masculin"}} 
    @else
        {{$sexe = "Féminin"}}
    @endif

    @if ($user->fonction == "user")
        {{$fonction = "Utilisateur"}}
    @else
        {{$fonction = "Administrateur"}}
    @endif
</code>
@section('content')
    <h1 style="text-align: center">Informations supplémentaires sur {{$user->nom}}</h1>
    <div class="row">
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control " id="nom" name="nom" placeholder="nom" value="{{$user->nom}}" readonly>
                <label for="nom">Nom</label>
            </div>
        </div>
        
        <div class="col-6">
            <!-- Prénom -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" value="{{$user->prenom}}" readonly>
                <label for="prenom">Prénom</label>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-6">
            <!-- Telephone -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('tel') is-invalid @enderror " id="tel" name="tel" placeholder="tel" value="{{$user->tel}}" readonly>
                <label for="tel">Téléphone</label>
            </div>
        </div>
        <!-- Sexe -->
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="sexe" name="sexe" placeholder="sexe" value="{{$sexe}}" readonly>
                <label for="sexe">Sexe</label>
            </div>
        </div>
    </div> 

    <!-- Adresse --><!-- Email Address --><!-- Telephone -->
    <!-- Date d'embauche --><!-- Nature du contrat --><!-- Service --><!-- Fonction -->
    <div class="row">
        <div class="col-6">
            <!-- Nature du contrat -->
            <div class="form-floating">
                <input type="text" class="form-control" id="natCont" name="natCont" value="{{$user->natCont}}" readonly>
                <label for="natCont">Nature du contrat</label>
            </div>
        </div>
        <div class="col-6">
            <!-- Date d'embauche -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="dateEmbauche" name="dateEmbauche" placeholder="dateEmbauche" value="{{$user->dateEmb}}" readonly>
                <label for="dateEmbauche">Date d'embauche</label>
            </div>
        </div>
        <div class="col-6">
            <!-- Service -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="tel" name="tel" placeholder="tel" value="{{$user->service->lib}}" readonly>
                <label for="tel">Service</label>
            </div>
        </div>
        <div class="col-6">
            <!-- Fonction -->
            <div class="form-floating">
                <input type="text" class="form-control" id="fonction" name="fonction" value="{{$fonction }}" readonly>
                <label for="fonction">Fonction</label>
            </div> 
        </div>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto mt-1">
        <a href="{{ route('admin.edit', [$user->id]) }}" class="btn btn-primary">Faire des modifications</a>
    </div>
@endsection