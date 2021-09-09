@component('mail::message')
# Introduction

{{$msg}}

@component('mail::button', ['url' => route('demande.show',$id)])
Plus de détails
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
