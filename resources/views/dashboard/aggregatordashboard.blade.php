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
     
    <section class="content">
               <div class="card card-info">
                   <div class="card-header">
                     <h3 class="card-title">Supply Detail Information</h3>
                   </div>
                 <!-- /.card-header -->
                   <div class="card-body">
                       <table id="example1" class="table table-bordered table-striped">
                       <div class="form-group row">
             <div class="col-md-4">
                  ProductName:<select class="form-control" name="agency_code" id="agency" >
                           <option disabled>Please select your ProductName</option>
                          </select>
              </div>
              
          </div>
                         <thead>
                           <tr>
                             <th>Sl. no</th>
                             <th>ProductName</th>
                             <th>Quantity</th>
                             <th>CostPrice</th>
                             <th>Tentitive Pickup Date</th>
                             <th>Remarks</th>
                             <th>Status</th>
                             <th>Action &nbsp;<span class="fa fa-cogs"></span></th>
                            </tr>
                         </thead>
                         <tr>
               <td> 1</td>
               <td>Potato</td>
               <td>12</td>
               <td>50</td>
               <td>12/05/2020</td>
               <td>rquiered</td>
               <td>rquiered</td>
            </tr>
            <td> 1</td>
               <td>Potato</td>
               <td>12</td>
               <td>50</td>
               <td>12/05/2020</td>
               <td>rquiered</td>
               <td>rquiered</td>
            </tr>
            <td> 1</td>
               <td>Potato</td>
               <td>12</td>
               <td>50</td>
               <td>12/05/2020</td>
               <td>rquiered</td>
               <td>rquiered</td>
            </tr>
         
                        </table>
                    </div>
                </div>  
           </section>

        </div>
    </div>
</div>  
@endsection