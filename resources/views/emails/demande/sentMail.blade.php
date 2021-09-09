@component('mail::message')
# Introduction

{{$msg}}

@component('mail::button', ['url' => route('demande.show',$demande->id)])
Voir la demande
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
