@extends('admin.layouts.master')
@section('content')
<style>
    path#SvgjsPath1162 {
    fill: #1e532e !important;
}
</style>
  <!-- Start Content-->
    <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

        <div class="row mb-3">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-md-center align-items-start">
                        <h5 class="card-title mb-0">Club/Business</h5>
                    </div>
                    <div class="card-body">
                        <div id="barChart" data-colors="#000,#000,#000,#000"></div>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- end row-->
        
    </div>

                    
                   
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{asset('assets/js/vendor/apexcharts.min.js')}}"></script>
<script>
              
            </script>
            <script>
                var colors = ["#1E532E"],
        dataColors = $("#barChart").data("colors")
                var activeusers = [];
                var inactiveuser = []
                var monthsss = [];
                var months = [];
                    <?php if(!empty($monthlyActiveUsers)){
                        foreach($monthlyActiveUsers as $monthlyUserItem){ ?>
                            monthsss.push("<?php echo ($monthlyUserItem['month'] ?? 0); ?>")
                            activeusers.push(<?php echo ($monthlyUserItem['users'] ?? 0); ?>)
                        <?php }
                    } ?>
                    <?php if(!empty($monthlyInactiveUsers)){
                        foreach($monthlyInactiveUsers as $monthlyUserItemss){ ?>
                            months.push("<?php echo ($monthlyUserItemss['month'] ?? 0); ?>")
                            inactiveuser.push(<?php echo ($monthlyUserItemss['users'] ?? 0); ?>)
                        <?php }
                    } ?>
                var options = {
                    series: [{
                        name: 'Active',
                        data: activeusers
                        
                    },
                    {
                        name: "Inactive",
                        data: inactiveuser
                    },],
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '15%',
                            colors: {
                                backgroundBarRadius: 10
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    colors: colors,
                    xaxis: {
                        categories: monthsss,
                    },
                    yaxis: {
                        title: {

                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#barChart"), options);
                chart.render();
      
    </script>
    
@endsection