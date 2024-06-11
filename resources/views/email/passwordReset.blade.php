@component('mail::message')
# Introduction

To reset your password, please click the Button below.

@component('mail::button', ['url' => 'https://bpdac.ca/confirm-password?token='.$token])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
