 <?php include 'header.inc.php'?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Posted Commisions</span>
              <span class="info-box-number">$3415.0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-sticky-note"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Payout</span>
              <span class="info-box-number">70<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

      </div>
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Payouts</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="250"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Mutual Funds</li>
                    <li><i class="fa fa-circle-o text-green"></i> Stocks</li>
                    <li><i class="fa fa-circle-o text-yellow"></i> Bonds</li>
                    <li><i class="fa fa-circle-o text-aqua"></i> Options</li>
                    
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
             <div class="info-box bg-blue-gradient" style="min-height:30px">
            <div class="info-box-content" style="margin:0">
              
              <div class="progress">
                <div class="progress-bar" style="width: 75%"></div>
              </div>
              <span class="progress-description">
                    You are only $1584.90 away from increasing your payout to 75% 
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
            </div>
            <!-- /.footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php include 'footer.inc.php'?>