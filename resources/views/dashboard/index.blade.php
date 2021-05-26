@extends('layouts.dashboard')
@section('asdf')
<meta http-equiv="refresh" content="100" />
@endsection
@section('title')
<span class="name">Welcome from Dashboard , {{Auth::user()->name}}</span>
@endsection
@section('content')
<div id="MyClockDisplay" class="clock" onload="showTime()"></div>
<br>
<div class="row" style="font-family: 'Inter', sans-serif;">
          <div class="col-xxl-3 col-xl-3 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 class="counter-count">{{ $users }}</h3>

                <p>Users</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-astronaut"></i>
              </div>
              <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xxl-3 col-xl-3 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color:#2ebf91;color:white;">
              <div class="inner">
                <h3 class="counter-count">{{ $categories }}</h3>

                <p>Categories</p>
              </div>
              <div class="icon">
                <i class="fas fa-stream"></i>
              </div>
              <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xxl-3 col-xl-3 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color:#799F0C;color:white;">
              <div class="inner">
                <h3 class="counter-count">{{ $foods }}</h3>

                <p>Foods</p>
              </div>
              <div class="icon">
                <i class="fas fa-hamburger"></i>
              </div>
              <a href="{{route('foods.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xxl-3 col-xl-3 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color:#0ED2F7;color:white;">
              <div class="inner">
                <h3 class="counter-count">{{ $orders }}</h3>

                <p>Orders</p>
              </div>
              <div class="icon">
              <i class="fas fa-clipboard-list nav-icon"></i>
              </div>
              <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div><!--row-->
        <div class="row" style="font-family: 'Inter', sans-serif;">
          <div class="col-xxl-3 col-xl-3 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color:#D3CCE3;color:white;">
              <div class="inner">
                <h3 class="counter-count">{{ $customers }}</h3>

                <p>Customers</p>
              </div>
              <div class="icon">
              <i class="fas fa-users"></i>
              </div>
              <a href="{{ route('customers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xxl-3 col-xl-3 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color:#859398;color:white">
              <div class="inner">
                <h3 class="counter-count">{{ $deliveries }}</h3>

                <p>Deliveries</p>
              </div>
              <div class="icon">
                <i class="fas fa-truck"></i>
              </div>
              <a href="{{ route('deliveries.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xxl-3 col-xl-3 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color:#fd1d1d;color:white">
              <div class="inner">
                <h3 class="counter-count">{{ $deliverymens }}</h3>

                <p>Deliverymen</p>
              </div>
              <div class="icon">
                <i class="fas fa-walking"></i>
              </div>
              <a href="{{route('deliverymens.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-xxl-3 col-xl-3 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color:#5D26C1;color:yellow">
              <div class="inner">
                <h3 class="d-inline-block counter-count">{{$total_earnings}}</h3>&nbsp;<h4 class="d-inline-block">Kyats</h4>

                <p>Total earnings</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <a href="{{route('orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div><!--row-->
        <div class="row" style="font-family: 'Poppins', sans-serif;">
          <div class="col-6 rounded-lg" style="background-color:white;">
            <div class="row mt-3"> 
              <div class="col-12">
                <div class="rounded-lg p-2" style="background-color:#E7FAEC;"> 
                  <a class="btn" id="order_1" href="{{ route('orders.index') }}">{{$order_0}}</a>
                  <span class="text-right ml-2" style="opacity:0.8;"><b>New Orders</b></span>&nbsp;
                  <i class="fas fa-circle" style="color:#2BC155;font-size:10px;"></i>
                  <a href="{{ route('orders.index') }}" class="float-right mr-3 mt-2" style="color:#2F4CDD;">Manage Orders&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                </div>
              </div> 
            </div><!--row--><br> 
            <div class="row"> 
              <div class="col-12">
               <div class="small-box" style="background-color:white;">
                  <div class="inner text-dark">
                    <h3 class="counter-count">{{ $order_3 }}</h3> 
                    <p>On Delivery</p> 
                  </div>
                  <div class="icon text-dark">
                    <i class="fas fa-running"></i>
                  </div>
                </div> 
              </div><!--col-12-->
            </div><!--row-->
            <div class="row"> 
              <div class="col-12">
               <div class="small-box" style="background-color:white;">
                <div class="inner text-info">
                  <h3 class="counter-count">{{ $order_4 }}</h3> 
                  <p>Delivered</p> 
                 </div>
                 <div class="icon text-info">
                    <i class="fas fa-check"></i>
                  </div>
                </div> 
              </div><!--col-12-->
            </div><!--row--> 
            <div class="row"> 
              <div class="col-12">
               <div class="small-box" style="background-color:white;">
                <div class="inner text-danger">
                  <h3 class="counter-count">{{ $order_2 }}</h3> 
                  <p>Canceled</p> 
                  <div class="icon text-danger">
                    <i class="fas fa-times"></i>
                  </div>
                 </div>
                </div> 
              </div><!--col-12-->
            </div><!--row--> 
          </div><!--col-6-->
          <div class="col-6" id="piechart" style="width: 900px; height: 500px;">
          </div>
        </div><br><!--row-->
        <div class="row">
          <div class="col-12" id="customer_chart">
          </div>
        </div><!--row--><br>
        
@endsection
@push('scripts')
<script type="text/javascript">
    var new_customers =  <?php echo json_encode($new_customers) ?>;
    Highcharts.chart('customer_chart', {
        title: {
            text: 'New Customers Growth, 2020'
        },
         xAxis: {
            categories: [ 'Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
        },
        yAxis: {
            title: {
                text: 'Number of New Customers'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'New Customers',
            data: new_customers
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
 
        function drawChart() {
 
        var data = google.visualization.arrayToDataTable([
            ['Month Name', 'Orders'],
 
                @php
                foreach($data['pieChart'] as $d) {
                    echo "['".$d->month_name."', ".$d->count."],";
                }
                @endphp
        ]);
 
          var options = {
            title: 'Orders',
            is3D: true,
          };
 
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
 
          chart.draw(data, options);
        }
        $('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
      </script>
@endpush