@extends('default')
@section('content')
    @if ($users->count() == 1)
        <h1 style="text-align: center">1 résultat trouvé </h1>
    @else
        <h1 style="text-align: center">{{$users->count() }} résultats trouvés</h1>
    @endif
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
                    <td colspan="5" style="text-align: center">Aucun résultat ne correspond à la recherche {{$request->input('search')}}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection