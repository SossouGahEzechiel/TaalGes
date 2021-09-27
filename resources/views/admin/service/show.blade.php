@extends('default')
@section('content')
    <h1>Service : {{$service->lib}}</h1>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" style="font-size: 2pc" id="lib" name="lib" placeholder="Libellé du service" value="{{$service->lib}}" readonly>
        <label for="lib">Libellé du service</label>
    </div>
    
    <div class="form-floating mb-3">
        <input type="text" class="form-control" style="font-size:" id="dir" name="dir" placeholder="dir" value="{{$service->boss()->nom}} {{$service->boss()->prenom}}" readonly>
        <label for="dir">Nom du directeur de service</label>
    </div>

    <p class="col-3 mx-auto">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#salarieList" aria-expanded="false" aria-controls="salarieList">
            Afficher ses salariés
        </button>
    </p>
    <div class="collapse" id="salarieList">
        <div><h2>Liste de ses salariés </h2> <h6 style="text-align: center">({{$service->salaries->count()}})</h6></div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($service->salaries as $user)
                    <tr class="">
                        {{-- @dd($service->salaries->count()) --}}
                        <th scope="row">{{$user->nom}}</th>
                        <td>{{$user->prenom}}</td>
                        <td>
                            <a href="{{ route('user.show', [$user->id]) }}" class="btn btn-secondary">Plus de détails</a>   &nbsp;&nbsp; 
                            {{-- <a class="btn btn-warning" href="{{ route('user.edit',$service->id) }}">Modifier</a>     --}}
                            @if ($user->id != Auth::user()->id)
                                <a class="btn btn-info" href="{{ route('admin.edit',$user->id) }}">Modifier</a>    &nbsp;&nbsp; 
                                <button class="btn btn-danger" onclick="return document.getElementById('searchDelete').style.display = 'block';">Retirer</button>                   
                            @else
                                <a class="btn btn-info disabled" href="{{ route('admin.edit',$user->id) }}">Modifier</a>    &nbsp;&nbsp; 
                                <button class="btn btn-danger disabled" onclick="return document.getElementById('searchDelete').style.display = 'block';">Retirer</button>                   
                            @endif                                 
                        </td>
                    </tr>
                @empty
                    <tr class="alert alert-warning">
                        <td colspan="3" style="text-align: center"><span>Pas salarié enrégistré dans ce service</span></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <a href="{{ route('service.edit', [$service->id]) }}" class=" btn btn-warning">Modifier les informations du service</a>
    <button onclick="return document.getElementById('serviceDelete').style.display = 'block';" class="btn btn-danger btn-group">Supprimer le service</button>
    
    {{-- Pour supprimer un utilisateur --}}
    @if ($service->salaries->count() > 0)
        <div class="modal fade show" id="searchDelete" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" style="padding-right: 17px; display:;">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-danger" style="text-align: center; font-size: 20px">Voulez-vous vraiment vous retirer cet salarié ? <br> <strong>Attention cette action sera irréversible</strong></div>
                <p style="padding-right: 45%""></p>
                <div class="modal-footer">
                <a class="btn btn-primary" onclick="return document.getElementById('searchDelete').style.display = 'none';" type="button" data-dismiss="modal" >Annuler</a>
                <form action="{{ route('user.destroy',$user->id) }}" method="POST" class="btn">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    @endif


    {{-- Pour supprimer un service --}}
    <div class="modal fade show" id="serviceDelete" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" style="padding-right: 17px; display:;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body text-danger" style="text-align: center; font-size: 15px">Voulez-vous vraiment vous retirer ce service ? Celà entrainerait la suppresion des salariées qui y sont employés</div>
            <p style="padding-right: 45%""></p>
            <div class="modal-footer">
              <a class="btn btn-primary" onclick="return document.getElementById('serviceDelete').style.display = 'none';" type="button" data-dismiss="modal" >Annuler</a>
              <form action="{{ route('service.destroy',$service->id) }}" method="POST" class="btn">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Supprimer</button>
              </form>
            </div>
          </div>
        </div>
    </div>
    @endsection