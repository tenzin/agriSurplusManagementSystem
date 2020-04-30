@extends('master')

@section('content')

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
          <p>Commerical Aggregator</p>
            <h3>20</h3>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
          <p>National Vegetable Company  </p>

            <h3>10</h3>

          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
          <p>Extension officer</p>
            <h3>10</h3>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        </div>
      </div>
    </div>
     
    
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <!-- BAR CHART -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Supply and Demand </h3>
            </div>

            <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
       <!-- DONUT CHART -->
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Donut Chart</h3>
            </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
        </div> 
    </div>
            <section class="content">
               <div class="card card-info">
                   <div class="card-header">
                     <h3 class="card-title">Supply Detail Information</h3>
                   </div>
                 <!-- /.card-header -->
                   <div class="card-body">
                       <table id="example1" class="table table-bordered table-striped">
                         <thead>
                           <tr>
                             <th>Sl. no</th>
                             <th>Produce</th>
                             <th>Quantity</th>
                             <th>CostPrice</th>
                             <th>Tentitive Pickup Date</th>
                             <th>Remarks</th>
                             <th>Status</th>
                             <th>Action &nbsp;<span class="fa fa-cogs"></span></th>
                            </tr>
                         </thead>
                        </table>
                    </div>
                </div>  
           </section>

        </div>
    </div>
</div>  
@endsection