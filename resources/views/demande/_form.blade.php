<br>
<div class="form-floating mb-3">
    <select class="form-select" id="auteur" name="auteur" aria-label="Floating label select example">
        <option value=" {{old('auteur')}} " hidden></option>
      @forelse ($sal as $sal)
        <option value="{{$sal->id}}">{{$sal->nom}}</option>
      @empty
          <option value="">Pas de salarier dans la base de données</option>
      @endforelse
    </select>
    <label for="auteur">Auteur de la demande</label>
</div>
{!!$errors->first('auteur','<div class="alert alert-danger" role="alert">:message</div>')!!}
<label class="form-check" for="check">Type de permission</label>
<div class="form-check-inline" id="check" >
    <input class="form-check-input" type="radio" name="typeDem" id="conge" value="conge">
    <label class="form-check-label" for="conge">
        Congé
    </label>
    </div>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="typeDem" id="permission" value="permission">
    <label class="form-check-label" for="permission">
        Permission
    </label>
</div>
{!!$errors->first('typeDem','<div class="alert alert-danger" role="alert">:message</div>')!!}
<br>
<div class="form-floating mb-3">
    <textarea class="form-control" name="objet"  id="objet" 
    value=" {{old('objet')}} "    
    style="height: 100px" placeholder="gr"></textarea>
    <label for="objet">Objet de la demande</label>
</div>
{!!$errors->first('objet','<div class="alert alert-danger" role="alert">:message</div>')!!}
<br>
<div class="form-group">
    <label for="dateDeb">Date de debut</label>
    <input type="date" class="form-control" id="dateDeb" name="dateDeb" value="">
</div>
{!!$errors->first('dateDeb','<div class="alert alert-danger" role="alert">:message</div>')!!}
<br>
<div class="form-floating mb-3">
    <input type="number" class="form-control" id="dure" name="dure" placeholder="vg" max="30" min="1">
    <label for="dure">Durée</label>
</div>
{!!$errors->first('dure','<div class="alert alert-danger" role="alert">:message</div>')!!}
<hr>
<a href="{{ route('dem.index') }}" class="btn btn-secondary">Annuler</a> &nbsp;
<button type="submit" class="btn btn-success">Valider</button>

