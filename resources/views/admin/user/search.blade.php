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
                        <a class="btn btn-secondary" href="{{ route('admin.show',$user->id) }}">Plus de détails</a>   &nbsp;&nbsp; 
                        <a class="btn btn-warning" href="{{ route('admin.edit',$user->id) }}">Modifier</a>    
                        <form action="{{ route('user.destroy',$user->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment retirer cet salarie ?? \n cette action sera irréversible')" class="btn">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>                          
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