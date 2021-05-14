@component('mail::message')
<p>Dear <b>{{$details['name']}}</b> , We sadly decline your Order! Because we have some issues or there may be some error.We apologize for your order.<br><br>
Order declined time = {{ $details['date'] }}<br>
Order_code = {{ $details['order_code'] }} <br>
But you can order again with us from the below button , </p>

@component('mail::button', ['url' => 'https://localhost:8000/shop'])
Click me to order again
@endcomponent

Thanks for ordering from us,<br>
<b>{{ config('app.name') }}</b>
@endcomponent
