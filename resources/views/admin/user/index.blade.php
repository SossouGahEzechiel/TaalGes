@extends('default')
@section('content')
    <h1 class="mb-0">Liste des Salariés</h1> <h6 style="text-align: center; font-style: oblique ">{{$total}}</h6> <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">NOM</th>
                <th scope="col">prénom</th>
                <th scope="col">Reserve</th>
                <th scope="col">Rôle</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="">
                    <th scope="row">{{$user->nom}}</th>
                    <td>{{$user->prenom}}</td>
                    <td>{{$user->reserve}}</td>
                    <td>
                        {{$user->fonction}}
                    </td>
                    <td>
                        <a class="btn" href="{{ route('admin.show',$user->id) }}" style="background-color: rgb(221, 218, 12)">Plus de détails</a>   &nbsp;&nbsp; 
                        @if ($user->id != Auth::user()->id)
                            <a class="btn btn-info" href="{{ route('admin.edit',$user->id) }}">Modifier</a>    &nbsp;&nbsp; 
                            <button class="btn btn-danger" onclick="return document.getElementById('supp').style.display = 'block';">Retirer</button>                   
                        @else
                            <a class="btn btn-info disabled" href="{{ route('admin.edit',$user->id) }}">Modifier</a>    &nbsp;&nbsp; 
                            <button class="btn btn-danger disabled" onclick="return document.getElementById('supp').style.display = 'block';">Retirer</button>                   
                        @endif
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center">Pas salarié enrégistré</td>
                <td><a href="{{ route('user.create') }}" class="btn btn-primary">Ajouter un nouveau Salarié</a></td>    
            </tr>
            @endforelse
        </tbody>
    </table>
    {{$users->links()}}
    <br>
    
@endsection