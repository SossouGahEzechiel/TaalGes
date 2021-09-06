@extends('default')
@section('content')
    <h1>Service : {{$service->lib}}</h1>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" style="font-size: 2pc" id="lib" name="lib" placeholder="Libellé du service" value="{{$service->lib}}" readonly>
        <label for="lib">Libellé du service</label>
    </div>
    
    <div class="form-floating mb-3">
        <input type="text" class="form-control" style="font-size: 2pc" id="dir" name="dir" placeholder="dir" value="null" readonly>
        <label for="dir">Nom du directeur de service</label>
    </div>
    <div><h1>Liste de ses salariés </h1> <h6 style="text-align: center">({{$service->salaries->count()}})</h6></div>
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
                <span>Pas salarié enrégistré</span>
            @endforelse
        </tbody>
    </table>
    <div class="d-grid gap-1 col-6 mx-auto">
        <a href="{{ route('service.edit', [$service->id]) }}" class=" btn btn-warning">Modifier le libellé du service</a>
        <form action="{{ route('service.destroy',[$service]) }}" class="btn  method="POST"
            onsubmit="return confirm('Voulez-vous vraiment retirer ce service ?? \n cette action effacera aussi tout les salariés qui y sont enrégistrés et sera irréversible')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-block"">Supprimer le service</button>
        </form>
    </div>
    @endsection