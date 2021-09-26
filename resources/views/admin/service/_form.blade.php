<div class="container col-7">
    <div class="form-floating mb-3">
        <input type="text" class="form-control @error('lib') is-invalid @enderror" onclick="lo();" placeholder="lib" name="lib" id="lib" value="{{old('lib') ?? $service->lib}}">
        <label for="lib">Libellé du service</label>
        @error('lib')<div class="alert alert-danger text-center">{{$message}}</div>@enderror
    </div>
    
    <div class="form-floating mb-3">
        <div class="form-floating">
            <select class="form-select @error('directeur_id') is-invalid @enderror " id="directeur_id" name="directeur_id" aria-label="Floating label select example">
                @foreach ($admins as $admin)
                    <option value="{{$admin->id}}" {{(old('directeur_id') == $admin->id) ? 'selected' : ''}} >{{$admin->nom}} {{$admin->prenom}}</option>
                @endforeach
            </select>
            <label for="directeur_id">Directeur du service</label>
        </div> 
    </div> 
        @error('directeur_id')<div class="alert alert-danger text-center">{{$message}}</div>@enderror
    <div class="d-grid gap-2 col-6 mx-auto mt-3">
        <button type="submit" class="btn btn-success">{{$action}}</button>
    </div>  
</div>