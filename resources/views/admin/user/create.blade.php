@extends('default')
@section('content')
    @foreach ($errors->all() as $message)
        {{ $message }}
    @endforeach
    <h1 style="text-align: center">Formulaire d'enrégistrement</h1>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        @include('admin.user._form')
        <div class="row mt-3">
            <!-- Password -->
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" name="password" placeholder="password" value="{{$user->password ?? old('password')}}" required autofocus>
                    <label for="password">Mot de passe</label>
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Confirm Password -->
           <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror " id="password_confirmation" name="password_confirmation" placeholder="password_confirmation" value="{{old('password_confirmation')}}" required autofocus>
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                </div>
                @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
           </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto mt-1">
            <button type="submit" class="btn btn-primary btn-block">Valider l'enrégistrement</button>
          </div>
    </form>
@endsection