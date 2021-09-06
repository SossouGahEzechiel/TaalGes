  @extends('default')
        
@section('content') 
    <form method="POST" action="{{ route('user.update',$user->id) }}">
        @method('PUT')
        @include('admin.user._form',['nat'=>'Mettre à jour les données'])
    </form>
@endsection