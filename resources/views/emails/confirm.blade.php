@component('mail::message')
# Hello {{$user->name}}

You have been changed your email, so we need to verify this new address. Pleasr use the link below:

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
