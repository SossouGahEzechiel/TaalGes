@extends('default')
@section('content')
    <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif">Mail d'avisement</h1><br>
    <p class="col-8 mx-auto" style="text-align: justify; font-family:Verdana, Geneva, Tahoma, sans-serif">
        La TAAL corporation tient à vous informer que votre collègue <strong>{{$demande->user->nom}}{{$demande->user->prenom}}</strong> du service des <strong>{{$demande->user->service->lib}}</strong>
        sera indisponible du {{$demande->dateDeb->locale("fr")->calendar()}} au {{($demande->dateDeb->addDays($demande->duree))->locale("fr")->calendar()}}. <br><br>
        Veuillez tenir compte de la présente annonce pour organiser vos activités. <br> <br>
        Merci de votre compréhension <br>TAAL-corporation

        <div style="text-align: center; font-style: italic; font-family: Verdana, Geneva, Tahoma, sans-serif">{{$notification->created_at->locale('fr')->calendar()}}</div>
    </p>
@endsection