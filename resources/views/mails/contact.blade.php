@component('mail::message')
# Welcome Sir
<p class="lead">User: <strong>{{$data['name']}}</strong> has a message for you</p>

Subject: 
<strong>{{ $data['subject'] }}</strong><br><br>
Message: 
<strong>{{ $data['message'] }}</strong>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
