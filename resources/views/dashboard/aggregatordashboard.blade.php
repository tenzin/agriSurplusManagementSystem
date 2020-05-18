@extends('master')
@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col-lg-3 col-6">
         <div class="small-box bg-info">
            <div class="inner">
               <p>Commerical Aggregator</p>
               <h3>20</h3>
            </div>
            <div class="icon">
               <i class="ion ion-bag"></i>
            </div>
         </div>
      </div>

      <div class="col-lg-3 col-6">
         <div class="small-box bg-success">
            <div class="inner">
               <p>Vegetable Supply Company  </p>
               <h3>10</h3>
            </div>
            <div class="icon">
               <i class="ion ion-stats-bars"></i>
            </div>
         </div>
      </div>

      <div class="col-lg-3 col-6">
         <div class="small-box bg-info">
            <div class="inner">
               <p>Regional Office</p>
               <h3>4</h3>
            </div>
            <div class="icon">
               <i class="ion ion-stats-bars"></i>
            </div>
         </div>
      </div>

      <div class="col-lg-3 col-6">
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
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-6">
               <div class="card card-success">
                  <div class="card-header">
                     <h3 class="card-title">Surplus Information</h3>
                  </div>
               <div class="card-body">
                  
               </div>
            </div>
         </div>

         <!-- Demand Info -->
         <div class="col-md-6">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Demand information</h3>
               </div>
               <div class="card-body">
               
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- Area of cultivation info -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-6">
               <div class="card card-success">
                  <div class="card-header">
                     <h3 class="card-title">Area of Cultivation</h3>
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
                              Geog:
                              <select class="form-control" name="date" id="agency" >
                                  <option disabled>Please select your Dzongkhag</option>
                              </select>
                           </div>
                        </div>
                        <thead>
                          <tr>
                           <th style="width: 10px">Sl.No</th>
                           <th>Product Name</th>
                           <th>Quantity</th>
                           <th>Estimated Production</th>
                           <th>Geog</th>
                           </tr>
                        </thead>
                        <tbody>
                          <tr>
                           <td>1</td>
                           <td>Potatoes</td>
                           <td>20 Acres</td>
                           <td>300kg</td>
                           <td>Khoma</td>
                          </tr>
                          <tr>
                           <td>2</td>
                           <td>Chilli</td>
                           <td>10 Acres</td>
                           <td>300kg</td>
                           <td>Minjey</td>
                           </tr>
                           <tr>
                           <td>3</td>
                           <td>Bringle</td>
                           <td>2 Acres</td>
                           <td>300kg</td>
                           <td>Paro</td>
                          </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>

         <!-- Surplus from other CA -->
            <div class="col-md-6">
               <div class="card card-info">
                 <div class="card-header">
                    <h3 class="card-title">Surplus From Other CA</h3>
                  </div>
                  <div class="card-body">
                     <table class="table table-bordered">
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
                           <th style="width: 10px">Sl.No</th>
                           <th>ProductName</th>
                           <th>Product Type</th>
                           <th>Quantity</th>
                           <th>Tantitive Pickup Date</th>
                           <th>Status</th>
                           <th style="width: 40px">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           <td>1</td>
                           <td>Cabbage</td>
                           <td>Vegetable</td>
                           <td>200kg</td>
                           <td>23/06/2020</td>
                           <td>New</td>
                           <td>view</td>
                          </tr>
                           <tr>
                           <td>1</td>
                           <td>Cabbage</td>
                           <td>Vegetable</td>
                           <td>200kg</td>
                           <td>23/06/2020</td>
                           <td>New</td>
                           <td>view</td>
                           </tr>
                         </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>   
   </section>

   <section class="content">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Extension Officer Information</h3>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl. no</th>
                     <th>Name</th>
                     <th>Gewog</th>
                     <th>Email</th>
                     <th>Contact</th>
                     <!-- <th>Action &nbsp;<span class="fa fa-cogs"></span></th> -->
                  </tr>
               </thead>
               <tr>
                 @foreach($users_data as $ud)
                     <td>{{$loop->iteration}}</td>
                     <td>{{$ud->name}}</td>
                     <td>{{$ud->gewog['gewog']}}</td>
                     <td>{{$ud->email}}</td>
                     
                     <td>{{$ud->contact_number}}</td>   
                 @endforeach
               </tr>
            </table>
         </div>
      </div>
   </section>
</div>  
@endsection