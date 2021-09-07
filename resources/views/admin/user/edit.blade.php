  @extends('default')
        
@section('content') 
    <form method="POST" action="{{ route('user.update',$user->id) }}">
        @method('PUT')
        @include('admin.user._form')
        <div class="d-grid gap-2 col-6 mx-auto mt-3">
          <button type="submit" class="btn btn-primary btn-block">Mettre à jour les données</button>
        </div>
    </form>
@endsection