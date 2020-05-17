@extends('master')

@section('custom_css')
@include('includes/chart-css')

@endsection
@section('content')

<div class="container-fluid">
   <div class="row">
      <!-- CA info-->
      <div class="col-lg-4 col-6">
         <div class="small-box bg-info">
            <div class="inner">
               <p>Aggregator And Veg.Supply Company</p>
               <h3>{{$vsc}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-bag"></i>
            </div>
         </div>
      </div>
      <!-- EO info-->
      <div class="col-lg-2 col-6">
         <div class="small-box bg-success">
            <div class="inner">
               <p>Extension Officer</p>
               <h3>{{$ex}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-stats-bars"></i>
            </div>
         </div>
      </div>
      <!-- LUC info-->
      <div class="col-lg-3 col-6">
         <div class="small-box bg-warning">
            <div class="inner">
               <p>Land User Certificate and ARDC</p>
               <h3>{{$luc}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-person-add"></i>
            </div>
         </div>
      </div>
      <!-- Farmer group info-->
      <div class="col-lg-3 col-6">
         <div class="small-box bg-primary">
            <div class="inner">
               <p>Farmer Groups</p>
               <h3>{{$farmer}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-pie-graph"></i>
            </div>
         </div>
      </div>
   </div>
  

<div class="content">
  <div class="row center">
  <div class="col-lg-6">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-title">Surplus Vs. Product</h5>
        </div>
        <div class="card-body chart">
          <canvas id="productStats" height="150px"></canvas>
        </div>
      </div>
   </div>
    <div class="col-lg-3">
      <div class="card type">
        <div class="card-header">
          <h4 class="card-title">Product Types</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                @foreach($producttype as $t)
                <tr>
                  <td>{{$t->type}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
   </div>
    <div class="col-lg-3">
      <div class="card product">
      <div class="card-header">
          <h4 class="card-title">Products</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                @foreach($product as $p)
                <tr>
                 <td>{{$p->product}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Overall Surplus</h5>

        </div>
        <div class="card-body chart">
          <canvas id="surplus" height="200px"></canvas>
        </div>
      </div>
    </div>
   <!-- Area of cultivation info -->
            <div class="col-md-6">
               <div class="card card">
                  <div class="card-header">
                     <h3 class="card-title">Area of Cultivation</h3>
                  </div>
                  <div class="card-body">
                     <table class="table table-bordered">
                        <div class="form-group row">
                           <div class="col-md-6">
                              ProductName:
                              <select class="form-control" name="agency_code" id="agency" >
                                  <option disabled>select your ProductName</option>
                              </select>
                           </div>
                        </div>
                        <thead>
                          <tr>
                           <th>Sl.No</th>
                           <th>Product Name</th>
                           <th>Quantity</th>
                           <th>Estimated Production</th>
                           </tr>
                        </thead>
                        <tbody>
                          <tr>
                           <td>1</td>
                           <td>Potatoes</td>
                           <td>20 Acres</td>
                           <td>300kg</td>
                          </tr>
                          <tr>
                           <td>2</td>
                           <td>Chilli</td>
                           <td>10 Acres</td>
                           <td>300kg</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
              <div class="card card-chart">
                <div class="card-header">
                 <h5 class="card-category">Surplus vs. month</h5>
                </div>
              <div class="card-body chart">
                   <canvas id="monthsurplus" height="200px"></canvas>
               </div>
            </div>
    </div>       
</div>
@endsection
@section('custom_scripts')
@include('includes/chart-js')
@include('includes/n-dashboard-stats')
@endsection
 <!-- Surplus Info-->
{{--<section class="content">
      <div class="card card-success">
         <div class="card-header">
            <h3 class="card-title">Surplus Vs Dzongkhags</h3>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <div class="form-group row">
                  <div class="col-md-3">
                     ProductName:
                     <select class="form-control" name="product" id="pro" >
                        <option disabled>Please select your Product Name</option>
                     </select>
                  </div>
                  <div class="col-md-3">
                     Dzongkhag:
                     <select class="form-control" name="date" id="agency" >
                        <option disabled>Please select your Date</option>
                     </select>
                  </div>
                  <div class="col-md-3">
                     Monthly:
                     <select class="form-control" name="date" id="agency" >
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
                     <th>Dzongkhag</th>
                     <th>Date</th>
                     <th>Remarks</th>
                  </tr>
               </thead>
               <tr>
                  <td> 1</td>
                  <td>Potato</td>
                  <td>12 ton</td>
                  <td>vegetable</td>
                  <td>Thimphu</td>
                  <td>12/05/2020</td>
                  <td>More Production</td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Chili</td>
                  <td>12kg</td>
                  <td>vegetable</td>
                  <td>Paro</td>
                  <td>12/06/2020</td>
                  <td>Not Good Quality</td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Bringle</td>
                  <td>12kg</td>
                  <td>vegetable</td>
                  <td>Lhuentse</td>
                  <td>12/06/2020</td>
                  <td>Not Good Quality</td>
               </tr>
            </table>
         </div>
      </div>
   </section>
</div>
@endsection--}}