@extends('default')
@section('content')
    <h2>Ma boîte mail</h2>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Date de réception</th>
            <th scope="col">Expéditeur</th>
            <th scope="col">message</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>         
            @forelse ($mails as $mail)
                <tr>
                    <th scope="row">{{$mail->created_at->locale('fr')->calendar()}}</th>
                    
                    @if ($mail->user->fonction === "admin" || $mail->user->id == Auth::user()->id)
                        <td>taalcorp@gmailcom</td>
                    @else
                        <td>{{$mail->user->nom}}</td>
                    @endif
                    <td>{{Str::limit($mail->message,75)}}</td>
                    <td>
                        <button class="btn btn-primary" onclick="visibility('<?php echo $mail->id; ?>')"; id="but">Plus</button>
                    </td>
                </tr>
                <tr colspan="4">
                    <td colspan="4" style="text-align: justify; display: none ; font-style: italic" id="{{$mail->id}}">{{$mail->message}}</td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align: center">Pas de mails disponibles dans la boîte</td></tr>
            @endforelse
        </tbody>
    </table>
    {{$mails->links()}}
@endsection