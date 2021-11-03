@extends('layouts.admin')

@section('title')
Dashboard
@endSection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Orders Overview</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Status Overview</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="status" height="600" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var month = <?php echo $month; ?>;
    var order = <?php echo $order; ?>;
    var barChartData = {
        labels: month,
        datasets: [{
            label: 'Orders',
            backgroundColor: "pink",
            data: order
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Orders'
                        },
                        ticks: {
                            min: 0,
                            max: 20,
                            stepSize: 2,
                            suggestedMin: 0.5,
                            suggestedMax: 5.5,
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        }
                    }],
                },    
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Monthly Orders'
                }
            }
        });
    };

    var pending = <?php echo $pending_count; ?>;
    var deliver = <?php echo $deliver_count; ?>;

    const data = {
        labels: [
            'Pending Orders',
            'Delivered Orders'
        ],
        datasets: [{
            label: 'Order Status',
            data: [pending, deliver],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(34,139,34)'
            ],
            hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
    };

    var myChart = new Chart(
        document.getElementById('status'),
        config
    );
</script>
@endSection