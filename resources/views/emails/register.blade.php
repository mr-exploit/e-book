@component('mail::message')
<p>MSG</p>
<p>Hello {{ $user->name}}</p>
<h2>Verify your account</h2>
<p>Before you can use all account features, we need to verify your account.</p>
@component('mail::button', ['url' => url('verify/'.$user->remember_token)])
Verify Your Account

@endcomponent
<p>If you didn’t create an account, contact us to deactivate the account.</p>

Thanks <br />
{{ config('app.name') }}

@endcomponent