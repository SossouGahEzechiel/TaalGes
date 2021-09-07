@component('mail::message')
# Mail de confirmation

{{$msg}}

@component('mail::button', ['url' => route('user.show',$id)])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
