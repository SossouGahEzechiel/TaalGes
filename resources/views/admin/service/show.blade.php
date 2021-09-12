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


    {{-- <p>
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Link with href
        </a>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Button with data-bs-target
        </button>
    </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
    </div> --}}


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
                        <a class="btn btn-warning" href="{{ route('user.edit',$service->id) }}">Modifier</a>    
                        <form action="{{ route('user.destroy',$user->id) }}" method="POST" 
                            onsubmit="return confirm('Voulez-vous vraiment retirer ce service ?? \n cette action effacera aussi tout les salariés qui y sont enrégistrés et sera irréversible')" class="btn">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>                          
                    </td>
                </tr>
            @empty
                <tr class="alert alert-warning">
                    <td colspan="3" style="text-align: center"><span>Pas salarié enrégistré dans ce service</span></td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('service.edit', [$service->id]) }}" class=" btn btn-warning">Modifier le libellé du service</a>
    <form action="{{ route('service.destroy',[$service]) }}" class="btn  method="POST"
        onsubmit="return confirm('Voulez-vous vraiment retirer ce service ?? \n cette action effacera aussi tout les salariés qui y sont enrégistrés et sera irréversible')">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-block"">Supprimer le service</button>
    </form>
    @endsection