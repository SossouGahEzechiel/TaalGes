@extends('default')
@section('content')
    {{-- @dd($service) --}}
    <h1 style="text-align: center;">Liste des différents services</h1><hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Nom du directeur</th>
                <th scope="col">Nombre de salarié</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
                <tr class="">
                    {{-- @dd($service->salaries->count()) --}}
                    <th scope="row">{{$service->lib}}</th>
                    <td>null</td>
                    <td>{{$service->salaries->count()}}</td>
                    <td>
                        <a href="{{ route('service.show', [$service->id]) }}" class="btn btn-secondary">Plus de détails</a>   &nbsp;&nbsp; 
                        <a class="btn btn-warning" href="{{ route('service.edit',$service->id) }}">Modifier</a>    
                        <form action="{{ route('service.destroy',$service->id) }}" method="POST" 
                            onsubmit="return confirm('Voulez-vous vraiment retirer ce service ?? \n cette action effacera aussi tout les salariés qui y sont enrégistrés et sera irréversible')" class="btn">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>                          
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center">Pas Service enrégistré</td>
                    <td><a href="{{ route('service.create') }}" class="btn btn-primary">Ajouter un nouveau service</a></td>    
                </tr>
            @endforelse
        </tbody>
    </table>
    {{$services->links()}}
        <br>
@endsection