@extends('default')
@section('content')
    @foreach ($errors as $error)
        @dump($error)
    @endforeach
    @if ($services->count()<1)
        <div class="alert alert-danger">Aucun service n'a été enrégitré, veuillez en ajouter avant d'ajouter un salarié </div>
        <a href="{{ route('service.create') }}" class="btn btn-primary">Ajouter un service</a>
    @else
        <h1>Formulaire d'enrégistrement d'un nouveau salarié</h1>
        <form action="{{ route('user.store') }}" method="POST" class="mt">
            @csrf
            @include('admin.user._form')
            <div class="row mt-3 mb-3">
                <!-- Password -->
                <div class="col-6">
                    <div class="form-floating ">
                        <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" name="password" placeholder="password" value="{{$user->password ?? old('password')}}" required autofocus>
                        <label for="password">Mot de passe</label>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- Confirm Password -->
            <div class="col-6 mb-3">
                    <div class="form-floating ">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror " id="password_confirmation" name="password_confirmation" placeholder="password_confirmation" value="{{old('password_confirmation')}}" required autofocus>
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                    </div>
                    @error('password_confirmation')
                        <div class="text-danger text-center">{{ $message }}</div>
                    @enderror
            </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mt-1">
                <button type="submit" class="btn btn-primary btn-block">Valider l'enrégistrement</button>
            </div>
        </form>
    @endif
@endsection