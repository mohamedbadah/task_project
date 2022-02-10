@component('mail::message')
# grids

The body of your message كيفك.<br>
{{$admin->name}}
@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/admin/login'])
Button Text
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
