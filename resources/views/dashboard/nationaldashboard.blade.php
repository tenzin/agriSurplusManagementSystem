@extends('master')
@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- CA info-->
      <div class="col-lg-4 col-6">
         <div class="small-box bg-info">
            <div class="inner">
               <p>Aggregator And Veg.Supply Company</p>
               <h3>140</h3>
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
               <h3>205</h3>
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
               <h3>10</h3>
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
               <h3>100</h3>
            </div>
            <div class="icon">
               <i class="ion ion-pie-graph"></i>
            </div>
         </div>
      </div>
   </div>
   <!-- Graph Part---->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-6">
               <!-- Supply VS. Product Type -->
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Supply VS. Product Type</h3>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                     </div>
                  </div>
               </div>
               <!-- Supply Demand Graph -->
               <div class="card card-success">
                  <div class="card-header">
                     <h3 class="card-title">Supply VS. Demand</h3>
                  </div>
                  <div class="card-body">
                     <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
               </div>
            </div>
            <!-- Demand VS. Product Type -->
            <div class="col-md-6">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">Demand VS. Product Type</h3>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                     </div>
                  </div>
               </div>
               <!-- Area Of Cultivation -->
               <div class="card card-success">
                  <div class="card-header">
                     <h3 class="card-title">Area Of Cultivation</h3>
                  </div>
                  <div class="card-body">
                     <table class="table table-bordered">
                        <div class="form-group row">
                           <div class="col-md-6">
                              ProductName:
                              <select class="form-control" name="agency_code" id="agency" >
                                 <option disabled>Please select your ProductName</option>
                              </select>
                           </div>
                           <div class="col-md-6">
                              Dzongkhag:
                              <select class="form-control" name="date" id="agency" >
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
                              <th>Geog</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>Potatoes</td>
                              <td>20 Acres</td>
                              <td>Lhuntse</td>
                              <td>Khoma</td>
                           </tr>
                           <tr>
                              <td>2</td>
                              <td>Chilli</td>
                              <td>10 Acres</td>
                              <td>Thimphu</td>
                              <td>Thimphu</td>
                           </tr>
                           <tr>
                              <td>3</td>
                              <td>Bringle</td>
                              <td>2 Acres</td>
                              <td>Paro</td>
                              <td>Paro</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Surplus Info-->
   <section class="content">
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
@endsection