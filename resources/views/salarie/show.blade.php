@extends('layout.base',['title'=>'Liste des salarie'])
@section('content')
    <code hidden>
        @switch($sal->civilite->libCiv)
            @case('Monsieur')
                {{$m = 'checked'}}
                {{$Ma= 'disabled'}}
                {{$ma= 'disabled'}}
                @break
            @case('Madame')
                {{$m = 'disabled'}}
                {{$Ma= 'checked'}}
                {{$ma= 'disabled'}}
                @break
            @case('Mademoiselle')
                {{$m = 'disabled'}}
                {{$Ma= 'disabled'}}
                {{$ma= 'checked'}}
                @break
            @default
        @endswitch
    </code>
    <h1>{{$sal->nom}}</h1>
    <div class="nn">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" value="{{$sal->nom}}" readonly>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" value="{{$sal->prenom}}" id="prenom" readonly>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" value="{{$sal->adresse}}" id="adresse" readonly>
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Contact</label>
            <input type="tel" class="form-control" value="{{$sal->tel}}" id="tel" readonly>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date d'embauche</label>
            <input type="text" class="form-control" value="{{$sal->dateEmb->format('j  F \(n\)  Y')}}" id="date" readonly>
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Nature du contrat</label>
            <input type="tel" class="form-control" value="{{$sal->natCont}}" id="tel" readonly>
        </div>
        <label for="tel" class="form-label">civilite</label>
        <div class="form-group container">            
            <div class="form-check form-check-inline">
                <input type="radio" id="monsieur" name="civilite" class="custom-control-input" {{$m}} >
                <label class="custom-control-label" for="monsieur">Monsieur</label>
            </div>   
            <div class="form-check form-check-inline">
                <input type="radio" id="madame" name="civilite" class="custom-control-input" {{$Ma}} >
                <label class="custom-control-label" for="madame">Madame</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="mademoiselle" name="civilite" class="custom-control-input" {{$ma}}>
                <label class="custom-control-label" for="mademoiselle">Mademoiselle</label>
            </div>           
        </div>
    </div>
    <div class="mb-3">
        <label for="tel" class="form-label">Liste des demandes effectuées</label>
        <div class="list-group-flush">
            @forelse ($sal->demandes as $demande)
                <a href="{{ route('dem.show', [$demande->id]) }}" class="list-group-item list-group-item-light"> Demande soumise le {{$demande->dateDem->format('j  F  Y')}}</a>
            @empty
                <span class="info">Pas de demande de permission émise par {{$sal->civilite->libCiv}}&nbsp;{{$sal->nom}}</span>
            @endforelse
        </div>
    </div>
    <hr>
    <a href="{{ route('sal.index') }}" class="btn btn-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
        </svg> Retour
    </a> &nbsp;&nbsp;
    <a href="{{ route('sal.edit', [$sal->id]) }}" class="btn btn-warning">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
        </svg> Modifier les données
        
    </a>
    <form action="{{ route('sal.destroy',$sal) }}" method="post" class="btn" onsubmit="return confirm('Voulez-vous supprimer  {{$sal->civilite->libCiv}} {{$sal->nom}}')">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
            </svg> Retirer
        </button>
    </form>
    <a href="{{ route('dem.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
        </svg> Faire une demande
    </a>
@endsection