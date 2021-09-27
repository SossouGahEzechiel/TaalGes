@extends('default')
@section('content')
    {{-- @dd($service) --}}
    <h1 style="text-align: center;">Liste des différents services</h1><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Nom du directeur</th>
                <th scope="col">Effectif</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
                <tr class="">
                    {{-- @dd($service->boss()) --}}
                    <th scope="row">{{$service->lib}}</th>
                    <td>{{$service->boss()->nom}} {{$service->boss()->prenom}}</td>
                    <td>{{$service->salaries->count()}}</td>
                    <td>
                        <a href="{{ route('service.show', [$service->id]) }}" class="btn btn-secondary">Plus de détails</a> 
                        <a class="btn btn-warning" href="{{ route('service.edit',$service->id) }}">Modifier</a> 
                        <button onclick="return document.getElementById('serviceDelete').style.display = 'block';" class="btn btn-danger">Supprimer</button>                       
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