@extends('master')

@section('content')

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
          <p>CA And NVSC</p>
            <h3>140</h3>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
          <p>Extension officer</p>

            <h3>205</h3>

          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
          <p>Land User Certificate and ARDC</p>
            <h3>10</h3>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
          <p>Farmers</p>
            <h3>100</h3>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Area of Cultivation</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                <div class="form-group row">
             <div class="col-md-6">
                  ProductName:<select class="form-control" name="agency_code" id="agency" >
                           <option disabled>Please select your ProductName</option>
                          </select>
              </div>
              <div class="col-md-6">
                  Dzongkhag:<select class="form-control" name="date" id="agency" >
                       <option disabled>Please select your Dzongkhag</option>
                    </select>
              </div>
          </div>
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Dzongkhag</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>24</td>
                      <td>lhuntse</td>
                      <td>active</td>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>24</td>
                      <td>lhuntse</td>
                      <td>active</td>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>24</td>
                      <td>lhuntse</td>
                      <td>active</td>
                    </tr>
                  </tbody>
                </table>
              </div>    
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Condensed Full Width Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-warning" style="width: 70%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-primary" style="width: 30%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-success" style="width: 90%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-success">90%</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bhutan Product</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                
                <div class="form-group row">
                      <div class="col-md-4">
                        ProductName:<select class="form-control" name="agency_code" id="agency" >
                                <option disabled>Please select your ProductName</option>
                                </select>
                    </div>
                    <div class="col-md-4">
                        Product Type:<select class="form-control" name="date" id="agency" >
                            <option disabled>Please select your Dzongkhag</option>
                          </select>
                    </div>
                 </div>
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>ProductName</th>
                      <th>Product Type</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>cabbage</td>
                      <td>vegetable</td>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>cabbage</td>
                      <td>vegetable</td>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>cabbage</td>
                      <td>vegetable</td>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>cabbage</td>
                      <td>vegetable</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
    


    <!-- ---->
    <section class="content">
   <div class="card card-success">
      <div class="card-header">
         <h3 class="card-title">Surplus Vs Dzongkhags</h3>
      </div>
      <div class="card-body">
         <table id="example1" class="table table-bordered table-striped">
         <div class="form-group row">
             <div class="col-md-3">
                  ProductName:<select class="form-control" name="agency_code" id="agency" >
                           <option disabled>Please select your ProductName</option>
                          </select>
              </div>
              <div class="col-md-3">
                  Dzongkhag:<select class="form-control" name="date" id="agency" >
                       <option disabled>Please select your Date</option>
                    </select>
              </div>
              <div class="col-md-3">
                  Monthly:<select class="form-control" name="date" id="agency" >
                       <option disabled>Please select your Month</option>
                    </select>
              </div>
          </div>
            <thead>
               <tr>
                  <th>Sl. no</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Product Type</th>
                  <th>Date</th>
                  <th>Remarks</th>
                  <th>Action &nbsp;<span class="fa fa-cogs"></span></th>
               </tr>
            </thead>
            <tr>
               <td> 1</td>
               <td>Potato</td>
               <td>12</td>
               <td>vegetable</td>
               <td>12/05/2020</td>
               <td>rquiered</td>
            </tr>
            <tr>
               <td> 1</td>
               <td>Potato</td>
               <td>12</td>
               <td>vegetable</td>
               <td>12/05/2020</td>
               <td>rquiered</td>
            </tr>
         </table>
      </div>
   </div>
</section>

      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->

  @endsection