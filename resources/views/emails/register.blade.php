@component('mail::message')

<p> Hello {{ $user->name }}!</p>

@component('mail::button', ['url'=>url('verify/'.$user->remember_token)])
VERIFY
@endcomponent
<p> If you have an error please contact with us!</p>

Thanks for joining us!<br />
App name "{{config('app.name')}}".
@endcomponent
