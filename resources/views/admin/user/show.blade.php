@extends('default')
<code hidden>
    @if ($user->sexe === 'M')
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
                    <label for="dureCont">Durée (en mois)</label>
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
    @if (Auth::user()->id == $user->id)
        <div class="d-grid gap-2 col-6 mx-auto mt-1">
            <a href="{{ route('admin.edit', [$user->id]) }}" class="btn btn-primary disabled">Faire des modifications</a>
        </div>
         <code hidden>{{$text = "Voir mes demandes"}} {{$text2 = $user->nom." Vous n'avez pas encore soumis de demandes"}}</code>
    @else
        <div class="d-grid gap-2 col-6 mx-auto mt-1">
            <a href="{{ route('admin.edit', [$user->id]) }}" class="btn btn-primary">Faire des modifications</a>
        </div>
         <code hidden>{{$text = "Lister ses demandes"}}{{$text2 = $user->nom." n'a pas encore soumis de demandes"}}</code>
    @endif
    <div class="d-grid gap-2 col-6 mx-auto mt-1">
        <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#demandesListe" aria-expanded="false" aria-controls="demandesListe">
            {{$text}}
        </button>
    </div>
    <div class="collapse mt-3" id="demandesListe">
        <div><h2>Liste de ses demandes </h2> <h6 style="text-align: center">({{$user->demandes->count()}})</h6></div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Datede soumission</th>
                        <th scope="col">Datede début</th>
                        <th scope="col">durée</th>
                        <th scope="col">Date de fin</th>
                        {{-- <th scope="col">objet</th> --}}
                        <th scope="col">Etat</th>
                        <th scope="col">Decision</th>
                    </tr>
                </thead>
                <tbody>         
                    @forelse ($user->demandes as $demande)
                        <code hidden>
                            @if ($demande->user_id == Auth::user()->id)
                                {{$self = "disabled"}}
                            @else
                                {{$self = ""}}
                            @endif
                            @switch($demande->decision)
                                @case("Refuse")
                                    {{$col = "table-warning"}}
                                    {{$btn = 'disabled' }}
                                    {{$decision = "Rejetée"}}
                                    @break
                                @case("Accorde")
                                    {{$col = "table-success"}}
                                    {{$btn = "disabled"}}
                                    {{$decision = "Accordée"}}
                                    @break
                                @case(null)
                                    {{$col = "table-info"}}
                                    {{$btn = ""}} 
                                    {{$decision = "En attente"}}
                                    @break
                                @default
                                
                            @endswitch
                        </code>
                        <tr class="{{$col}}">
                            <th>{{$demande->typeDem}}</th>
                            <th>{{$demande->created_at->format('d/m/y')}}</th>
                            <td>{{$demande->dateDeb->format('d/m/y')}}</td>
                            <td>{{$demande->duree}}</td>
                            <td>{{($demande->dateDeb->addDays($demande->duree))->format('d/m/y')}}</td>
                            {{-- <td>{{Str::limit($demande->objet,40)}}</td> --}}
                            <td>
                                {{$decision}}
                            </td>
                            <td>
                                <a href="{{ route('demande.show', [$demande->id]) }}" class="btn btn-primary">Plus</a>
                                <form action="{{ route('demande.update', [$demande->id]) }}" method="POST" class="btn"
                                    onsubmit="return confirm('Voulez-vous vraiment confirmer cette demande ??')">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-success {{$btn}} " {{$self}}>Accepter</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center">Aucune demande n'a encore été faite</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    </div>
@endsection