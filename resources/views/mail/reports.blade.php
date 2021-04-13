@component('mail::message')
# Запрошен новый отчёт по количеству сущностей на сайте:

{!! $reports !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
