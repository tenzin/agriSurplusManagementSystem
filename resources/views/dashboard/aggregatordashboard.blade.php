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
                     ProductName:
                     <select class="form-control" name="agency_code" id="agency" >
                        <option disabled>Please select your ProductName</option>
                     </select>
                  </div>
                  <div class="col-md-4">
                     Status:
                     <select class="form-control" name="agency_code" id="agency" >
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
                     <th>Geog</th>
                     <th>Submitted By</th>
                     <th>Status</th>
                     <th>Remarks</th>
                     <th>Action &nbsp;<span class="fa fa-cogs"></span></th>
                  </tr>
               </thead>
               <tr>
                  <td> 1</td>
                  <td>Potato</td>
                  <td>12</td>
                  <td>50</td>
                  <td>12/05/2020</td>
                  <td>Khoma</td>
                  <td>Extension officer</td>
                  <td></td>
                  <td>Avaliable</td>
               </tr>
               <td> 2</td>
               <td>Curliflower</td>
               <td>12</td>
               <td>50</td>
               <td>12/05/2020</td>
               <td>Minjey</td>
               <td>LUC</td>
               <td>Avaliable</td>
               </tr>
               <td> 3</td>
               <td>Cabbages</td>
               <td>12</td>
               <td>50</td>
               <td>12/05/2020</td>
               <td>Khoma</td>
               <td>Extension officer</td>
               <td>Avaliable</td>
               </tr>
               <td> 4</td>
               <td>Chilli</td>
               <td>12</td>
               <td>100</td>
               <td>12/05/2020</td>
               <td>Kabesa</td>
               <td>Farmer</td>
               <td>Avaliable</td>
               </tr>
            </table>
         </div>
      </div>
    </section>
   <section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-6">
            <div class="card card-success">
               <div class="card-header">
                  <h3 class="card-title">Area of Cultivation</h3>
               </div>
               <!-- /.card-header -->
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
                           Geog:
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
                           <th>Geog</th>
                           <th style="width: 40px">Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td>Potatoes</td>
                           <td>20 Acres</td>
                           <td>Khoma</td>
                        </tr>
                        <tr>
                           <td>2</td>
                           <td>Chilli</td>
                           <td>10 Acres</td>
                           <td>Minjey</td>
                        </tr>
                        <tr>
                           <td>3</td>
                           <td>Bringle</td>
                           <td>2 Acres</td>
                           <td>Paro</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <!-- /.col -->
         <div class="col-md-6">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Surplus and Demand</h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table class="table">
                     <div class="form-group row">
                        <div class="col-md-4">
                           Product Name:
                           <select class="form-control" name="date" id="agency" >
                              <option disabled>Please select your Product Type</option>
                           </select>
                        </div>
                        <div class="col-md-4">
                           Status:
                           <select class="form-control" name="date" id="agency" >
                              <option disabled>Please select your Product Type</option>
                           </select>
                        </div>
                        <div class="col-md-4">
                           Date:
                           <select class="form-control" name="date" id="agency" >
                              <option disabled>Please select your Product Type</option>
                           </select>
                        </div>
                     </div>
                     <thead>
                        <tr>
                           <th style="width: 10px">#</th>
                           <th>ProductName</th>
                           <th>Status</th>
                           <th>Date</th>
                           <th>Remark</th>
                           <th style="width: 40px">Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td>Cabbage</td>
                           <td>Surplus</td>
                           <td>23/06/2020</td>
                        </tr>
                        <tr>
                           <td>2</td>
                           <td>Chilli</td>
                           <td>Surplus</td>
                           <td>23/06/2020</td>
                        </tr>
                        <tr>
                           <td>3</td>
                           <td>Apple</td>
                           <td>Demand</td>
                           <td>23/06/2020</td>
                        </tr>
                        <tr>
                           <td>4</td>
                           <td>Rice</td>
                           <td>Demand</td>
                           <td>23/06/2020</td>
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
</div>
@endsection