@extends('default')       
@section('content') 
  @foreach ($errors->all() as $message)
  {{ $message }}
  @endforeach
  @if (Auth::user()->fonction === "admin")
    <h1 style="text-align: center">Formulaire de mise à jour de données</h1>
  @else
    <h1 style="text-align: center">Mettre à jour mes informations</h1>
  @endif
  <form method="POST" action="{{ route('user.update',$user->id) }}">
      @method('PUT')
      @include('admin.user._form')
      <div class="d-grid gap-2 col-6 mx-auto mt-3">
        <button type="submit" class="btn btn-primary btn-block">Mettre à jour les données</button>
      </div>
  </form>
@endsection