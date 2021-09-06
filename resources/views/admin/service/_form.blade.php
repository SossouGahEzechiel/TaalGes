<div class="form-floating mb-3">
    <input type="text" class="form-control @error('lib') is-invalid @enderror" placeholder="lib" name="lib" id="lib" value="{{old('lib') ?? $service->lib}}">
    <label for="lib">Libellé du service</label>
    @error('lib')<div class="alert alert-danger">{{$message}}</div>@enderror
</div>
<hr>  
<div class="d-grid gap-2 col-6 mx-auto">
    <button type="submit" class="btn btn-success">{{$action}}</button>
</div>  