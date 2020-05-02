@component('mail::message')
# Thank you for signing up

Hello {{$user['name']}},
Welcome to {{config('app.name')}}, you need to activate your account to share your GIF.<br>

@component('mail::button', ['url' => route('users.activate', Crypt::encrypt($user['id']))])
Activate Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
