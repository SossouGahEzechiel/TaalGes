@component('mail::message')
# Note d'information

{{$msg}}

Merci pour votre compréhension,<br>
{{ config('app.name') }}
@endcomponent
