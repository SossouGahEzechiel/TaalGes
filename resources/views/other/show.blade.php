@extends('other.layout.obase')
@section('content')
    <h1>kunh</h1>
    <p>Accepter le congé ou non ?</p>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="accépté">
            <label class="form-check-label" for="inlineRadio2">Accépter</label>
        </div><br>
        <a href="{{ route('other.edit',$conge->id) }}" class="btn btn-primary">Retour</a>
        <a href="{{ route('other.index') }}" class="btn btn-secondary">Retour</a>
@endsection