<div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom du salarier" value="{{old('nom') ?? $sal->nom}}">
</div>
{!!$errors->first('nom','<div class="alert alert-danger" role="alert">:message</div>')!!}
<div class="form-group">
    <label for="prenom">Prénom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom du salarier" value="{{old('prenom') ?? $sal->prenom}}">
</div>
{!!$errors->first('prenom','<div class="alert alert-danger" role="alert">:message</div>')!!}
<div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse du salarier" value="{{old('adresse') ?? $sal->adresse}}">
</div>{!!$errors->first('adresse','<div class="alert alert-danger" role="alert">:message</div>')!!}
<div class="form-group">
    <label for="telephone">Téléphone</label>
    <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Contact du salarier" value="{{old('telephone') ?? $sal->tel}}">
</div>{!!$errors->first('telephone','<div class="alert alert-danger" role="alert">:message</div>')!!}
@if ($sal->dateEmb)
    <div class="form-group">
        <label for="dateEmbauche">Actuelle date d'embauche</label>
        <input type="text" class="form-control" id="dateEmbauche" name="dateEmbauche" value="{{$sal->dateEmb->format('l \l\e d F Y')}}" readonly>
    </div>
@endif
<div class="form-group">
    <label for="dateEmbauche">Date d'embauche</label>
    <input type="date" class="form-control" id="dateEmbauche" name="dateEmbauche" placeholder="Date d'embauche du salarier" value="{{old('dateEmbauche') ?? $sal->dateEmb}}">
</div>
{!!$errors->first('dateEmbauche','<div class="alert alert-danger" role="alert">:message</div>')!!}
<label for="natCont">Nature du contrat</label><br>
<div class="form-group container">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="natCont" id="cdd" value="CDD">
        <label class="form-check-label" for="cdd">CDD</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="natCont" id="cdi" value="CDI">
        <label class="form-check-label" for="cdi">CDI</label>
    </div>
</div>
{!!$errors->first('natCont','<div class="alert alert-danger" role="alert">:message</div>')!!}
<div class="form-group">
    <label for="fonction">Fonction</label>
    <select class="form-control" id="fonction" name="fonction">
        <option value="" hidden selected></option>
        @foreach ($fonc as $fonction)
            <option value="{{$fonction->id}}">{{$fonction->libFonc}}</option>
        @endforeach
    </select>
</div>{!!$errors->first('fonction','<div class="alert alert-danger" role="alert">:message</div>')!!}
<div class="form-group">
    <label for="fonction">Service</label>
    <select class="form-control" id="service" name="service">
        <option value="" hidden selected></option>
        @foreach ($service as $service)
            <option value="{{$service->id}}">{{$service->libServ}}</option>
        @endforeach
    </select>
</div>{!!$errors->first('service','<div class="alert alert-danger" role="alert">:message</div>')!!}
<label for="civilite">Civilite</label><br>
<div class="form-group container">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="civilite" id="Monsieur" value="1">
        <label class="form-check-label" for="Monsieur">Monsieur</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="civilite" id="Madame" value="2">
        <label class="form-check-label" for="Madame">Madame</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="civilite" id="Mademoiselle" value="3">
        <label class="form-check-label" for="Mademoiselle">Mademoiselle</label>
    </div>
</div>{!!$errors->first('civilite','<div class="alert alert-danger" role="alert">:message</div>')!!}
<hr>&nbsp;
<a href="{{ route('sal.index') }}" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
    </svg> 
    Revenir à la liste des Salariers</a>
&nbsp;<button type="submit" class="btn btn-success">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
    </svg> 
    Valider</button>&nbsp;