@component('mail::message')

<p> Hello {{ $user->name }}!</p>

@component('mail::button', ['url'=>url('reset/'.$user->remember_token)])
RESET YOUR PASSWORD
@endcomponent
<p> Reset your password clicking button!</p>

Thanks for joining us!<br />
App name "{{config('app.name')}}".
@endcomponent
