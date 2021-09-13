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
    {{-- Nom et prénom --}}
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
    {{-- Sexe et adresse --}}
    <div class="row">
        <!-- Sexe -->
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="sexe" name="sexe" placeholder="sexe" value="{{$sexe}}" readonly>
                <label for="sexe">Sexe</label>
            </div>
        </div>
        <!-- Adresse -->
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse" value="{{$user->adresse}}" readonly>
                <label for="adresse">Adresse</label>
            </div>
        </div>
    </div> 
    <!-- Email Address --><!-- Telephone -->
    <div class="row">
        <div class="col-6">
            <!-- Email -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control id="email" name="email" placeholder="email" value="{{$user->email}}" readonly>
                <label for="email">Email</label>
            </div>
        </div>
        <div class="col-6">
            <!-- Telephone -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control id="tel" name="tel" placeholder="tel" value="{{$user->tel}}" readonly>
                <label for="tel">Téléphone</label>
            </div>
        </div>
        
    </div>
    <!-- Date d'embauche --><!-- Nature du contrat --><!-- Service --><!-- Fonction -->
    <div class="row">
        <div class="col-6">
            <!-- Date d'embauche -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="dateEmbauche" name="dateEmbauche" placeholder="dateEmbauche" value="{{$user->dateEmb->format('d/m/y')}}" readonly>
                <label for="dateEmbauche">Date d'embauche</label>
            </div>
        </div>
        @if ($user->natCont === "CDD")
            <div class="col-4">
                <!-- Nature du contrat -->
                <div class="form-floating">
                    <input type="text" class="form-control" id="natCont" name="natCont" value="{{$user->natCont}}" readonly>
                    <label for="natCont">Nature du contrat</label>
                </div>
            </div>
            <div class="col-2">
                <!-- Nature du contrat -->
                <div class="form-floating">
                    <input type="text" class="form-control" id="dureCont" name="dureCont" value="{{$user->dureCont}}" readonly>
                    <label for="dureCont">Durée du contrat</label>
                </div>
            </div>
        @else
            <div class="col-6">
                <!-- Nature du contrat -->
                <div class="form-floating">
                    <input type="text" class="form-control" id="natCont" name="natCont" value="{{$user->natCont}}" readonly>
                    <label for="natCont">Nature du contrat</label>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        @if ($departement)
            <div class="col-3">
                <!-- Fonction -->
                <div class="form-floating">
                    <input type="text" class="form-control" id="fonction" name="fonction" value="{{$departement->lib }}" readonly>
                    <label for="fonction">Département</label>
                </div> 
            </div>
        @else
            <div class="col-3">
                <!-- Fonction -->
                <div class="form-floating">
                    <input type="text" class="form-control" id="fonction" name="fonction" value="Salarié" readonly>
                    <label for="fonction">Fonction</label>
                </div> 
            </div>
        @endif
        <div class="col-3">
            <!-- Service -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="service" name="service" placeholder="service" value="{{$user->service->lib}}" readonly>
                <label for="service">Service</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="tel" name="tel" placeholder="tel" value="{{$user->reserve}}" readonly>
                <label for="tel">Reserve</label>
            </div>
        </div>
        @if ($last)
            <div class="col-3">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="last" name="last" placeholder="last" value="{{$last}}" readonly>
                    <label for="last">Dernière permission en date</label>
                </div>
            </div>
        @else
            <div class="col-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="last" name="last" placeholder="last" value="N/A" readonly>
                    <label for="last">Dernière permission en date</label>
                </div>
            </div>
        @endif
    </div>

    @if ($user->id == Auth::user()->id)
        <div class="d-grid gap-2 col-6 mx-auto mt-1">
            <a class="btn btn-primary" disabled onclick="vient()">Faire des modifications</a>
        </div>
    @else
        <div class="d-grid gap-2 col-6 mx-auto mt-1">
            <a href="{{ route('admin.edit', [$user->id]) }}" class="btn btn-primary">Faire des modifications</a>
        </div>
    @endif
@endsection