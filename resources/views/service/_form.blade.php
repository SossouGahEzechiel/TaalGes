<h1>Modification des données du service {{$serv->libServ}}</h1>
<div class="form-group">
    <label for="lib">Libellé du service</label>
    <input type="text" class="form-control" name="lib" id="lib" value="{{old('lib') ?? $serv->libServ}}">
    {!!$errors->first('lib','<div class="alert alert-danger">:message</div>')!!}
</div>
<hr>    
<button type="submit" class="btn btn-success">Valider</button>