@extends('partners.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Dashboard')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            
            <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>
                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a href="#" class="dropdown-item">Action</a>
                            <a href="#" class="dropdown-item">Another action</a>
                            <a href="#" class="dropdown-item">Something else here</a>
                            <a class="dropdown-divider"></a>
                            <a href="#" class="dropdown-item">Separated link</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center">
                            <strong>Sales Graph: {{ date('d F Y', strtotime($first_date)) }} - {{ date('d F Y', strtotime($last_date)) }}</strong>
                        </p>
                        
                        <div class="chart">
                            <!-- Sales Chart Canvas -->            
                            <canvas id="visitors-chart" class="chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                    <!-- /.chart-responsive -->
                    <!-- /.col -->
                    <div class="col-md-4">
                        <p class="text-center">
                            <strong>Sales Process</strong>
                        </p>
                        
                        <div class="progress-group">
                            Complete Purchase
                            <span class="float-right"><b>310</b>/400</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: 75%"></div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                            <h5 class="description-header">IDR 0</h5>
                            <span class="description-text">TOTAL REVENUE <br><small>(ALL)</small></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                            <h5 class="description-header">$10,390.90</h5>
                            <span class="description-text">INCOME <br><small>(LAST MONTH)</small></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                            <h5 class="description-header">IDR {{number_format($total_amount, 2, ',', '.')}}</h5>
                            <span class="description-text">INCOME <br><small>(THIS MONTH)</small></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                        <div class="description-block">
                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                            <h5 class="description-header">1200</h5>
                            <span class="description-text">TOTAL OUTCOME <br><small>(ALL)</small></span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('script')
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }
        
        var mode      = 'index'
        var intersect = true
        
        var s_visitorsChart = $('#visitors-chart');
        var visitorsChart  = new Chart(s_visitorsChart, {
            data   : {
                labels  : {!! json_encode($list_date) !!},
                datasets: [{
                    type                : 'line',
                    data                : {!! json_encode($list_amount) !!},
                    backgroundColor     : 'transparent',
                    borderColor         : '#4B94BF',
                    pointBorderColor    : '#4B94BF',
                    pointBackgroundColor: '#4B94BF',
                    label               : 'Revenue',
                    borderWidth         : 2,
                    lineTension         : 0,
                    fill                : false
                    // pointHoverBackgroundColor: '#007bff',
                    // pointHoverBorderColor    : '#007bff'
                },
                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips           : {
                    mode     : mode,
                    intersect: intersect
                },
                hover              : {
                    mode     : mode,
                    intersect: intersect
                },
                legend             : {
                    display: false
                },
                scales             : {
                    yAxes: [{
                        // display: false,
                        gridLines : {
                            display : true,
                            color: '#898989',
                            drawBorder: false,
                        },
                        ticks    : $.extend({
                            beginAtZero : true,
                            suggestedMax: 200
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display  : true,
                        gridLines : {
                            display : true,
                            color: '#898989',
                            drawBorder: false,
                        },
                        ticks    : ticksStyle
                    }]
                }
            }
        });
    })
</script>
@endsection