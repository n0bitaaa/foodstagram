@component('mail::messages')
<p>Dear <b>{{$details[0]['name']}}</b> , We gladly accepted your order! Your orders will be on the way in a few minutes.<br>
Here is your receipt -</p>
<p>
Order accept time = {{ $details[0]['date'] }}<br>
Order_code = {{ $details[0]['order_code'] }}
</p>
<table align="center">
                    <thead>
                        <tr>
                            <th>Items</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($details as $detail)
                       <tr align="center">
                            <td>{{$detail['items']}}</td>
                            <td>{{ $detail['qty']}}</td>
                            <td>{{ number_format($detail['price']) }} Kyats</td>
                            <td>{{ number_format($detail['price']*$detail['qty'])}} Kyats</td>
                       </tr>
                       @endforeach
                       <tr align="center">
                           <td></td>
                           <td></td>
                           <td>Total Amount</td>
                           <td>{{ number_format($details[0]['order_total_price']) }} Kyats</td>
                       </tr>
                    </tbody>
</table>
<p style="text-transform:capitalize;">Your location - {{ $details[0]['location']}} </p>
Thanks for ordering from us,<br>
<b>{{ config('app.name') }}</b>
@endcomponent