@component('mail::message')
# Post Updated

This post has been updated:
## {{ $title }}
### {{ $body }}

@component('mail::button', ['url' => config('app.url') . '/posts' ])
View Blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent