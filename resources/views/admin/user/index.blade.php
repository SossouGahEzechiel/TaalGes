@extends('default')
@section('content')
    <h1 style="text-align: center;">Liste des Salariés</h1> <br>
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
                        @if ($user->id == Auth::user()->id)
                            <a class="btn btn-info" onclick="vient();" aria-disabled="true">Modifier</a>    &nbsp;&nbsp;
                            <button type="submit" class="btn btn-danger" onclick="vient();">Supprimer</button>
                        @else
                            <a class="btn btn-info" href="{{ route('admin.edit',$user->id) }}">Modifier</a>    
                            <form action="{{ route('user.destroy',$user->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment retirer cet salarie ?? \n cette action sera irréversible')" class="btn">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
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