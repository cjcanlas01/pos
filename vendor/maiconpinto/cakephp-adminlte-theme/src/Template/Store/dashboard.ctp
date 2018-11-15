<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 id="tsales">0</h3>

              <p>Today's Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'salesreportspage')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="pday">0</h3>
              <!-- <sup style="font-size: 20px">%</sup> -->

              <p>Today's Purchases</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'purchasesreportspage')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="curinvlvl">0</h3>

              <p>Current Inventory Weight</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert"></i>
            </div>
            <a href="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'inventoryreportspage')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="numoftrns">0</h3>

              <p>Number of Transactions</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <span class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></span>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

  <!-- BAR CHART -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Sales and Purchases Comparison</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="chart">
        <canvas id="barChart" style="height:230px"></canvas>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Sales Representation</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body chart-responsive">
      <div class="chart" id="line-chart" style="height: 300px;"></div>
    </div>
    <!-- /.box-body -->
  </div>

  <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <!--<div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div> -->
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

  </div>
  <!-- /.content-wrapper -->

</section>
<!-- /.content -->

<?php

    $this->Html->css([
      'AdminLTE./plugins/morris/morris'
   ],
   ['block' => 'css']);

    $this->Html->script([
      'AdminLTE./plugins/money-input/accounting',
      'AdminLTE./plugins/chartjs/Chart',
      'AdminLTE./plugins/morris/morris.min',
      'AdminLTE./plugins/raphael/raphael.min'
    ],
    ['block' => 'script']);

?>

<?php $this->start('scriptBottom'); ?>
<script>

   var barchrtsales = [];
   var barchrtpurchases = [];

   var pastyearlinechart = [];
   var currentyearlinechart = [];

   var prodelem, sofielem, userdetails;

   var tdate = new Date();
   var dd = tdate.getDate()//yields date
   var MM = tdate.getMonth() + 1; //yields month
   var yyyy = tdate.getFullYear(); //yields year
   var currentDate = yyyy + "-" + MM + "-" + dd;

   $(document).ready(function(){
        dashboardcomp(currentDate, MM, dd, yyyy);
   });

       //Start of important methods
       function dashboardcomp(date, month, day, year)
       {
         var result = null;
         jQuery.ajax({
           url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'dashboardcomp')); ?>',
           type: 'post',
           dataType: 'json',
           data: {date: date, month: month, day: day, year: year},
           success:function(data)
           {
               result = data;
               $('#tsales').html(maskNumA(result[0]));
               $('#pday').html(maskNumA(result[1]));
               $('#curinvlvl').html(maskNumA(result[2]));
               $('#numoftrns').html(parseInt(result[3][0]['id']) + parseInt(result[4][0]['id']));

               for(var i=0; i<12; i++) {
                    barchrtsales[i] = result[5][i][0]['id'];
                    barchrtpurchases[i] = result[6][i][0]['id'];
               }

               for(var i=0; i<4; i++) {
                    currentyearlinechart[i] = result[7][0][i];
                    pastyearlinechart[i] = result[7][1][i];
               }

               barchart();
               linechart();

           }
          });
       }
       //End of important methods

    function barchart()
    {
      var areaChartData = {
          labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          datasets: [
            {
              label               : 'Purchases',
              fillColor           : 'rgba(210, 214, 222, 1)',
              strokeColor         : 'rgba(210, 214, 222, 1)',
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#c1c7d1',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : barchrtpurchases,
            },
            {
              label               : 'Sales',
              fillColor           : 'rgba(60,141,188,0.9)',
              strokeColor         : 'rgba(60,141,188,0.8)',
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : barchrtsales,
            }
          ]
        }
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }
    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
    }

    function linechart()
    {
        // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
            {y: (yyyy - 1) + " Q1", Q1: pastyearlinechart[0]},
            {y: (yyyy - 1) + " Q2", Q1: pastyearlinechart[1]},
            {y: (yyyy - 1) + " Q3", Q1: pastyearlinechart[2]},
            {y: (yyyy - 1) + " Q4", Q1: pastyearlinechart[3]},
            {y: yyyy + " Q1", Q1: currentyearlinechart[0]},
            {y: yyyy + " Q2", Q1: currentyearlinechart[1]},
            {y: yyyy + " Q3", Q1: currentyearlinechart[2]},
            {y: yyyy + " Q4", Q1: currentyearlinechart[3]},
          ],
          xkey: 'y',
          ykeys: ['Q1'],
          labels: ['Sales'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto',
          parseTime: false
        });
    }

   //Start of misc methods
    function maskNumA (value){
      return accounting.formatNumber(value, 2);
    }

    function unmaskNumA (value){
        return accounting.unformat(value);
    }
   //End of misc methods

</script>
<?php $this->end(); ?>
