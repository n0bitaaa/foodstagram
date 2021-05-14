@component('mail::message')
<p>Dear <b>{{ $details['name'] }}</b> , We completely delivered your order.If you have any issue or if you dont still have your order , Please contact directly from 09261105262. Enjoy your meals.<br><br>
Order_code = {{ $details['code'] }}<br>

Thanks for ordering from us,<br>
<b>{{ config('app.name') }}</b></p>
@endcomponent