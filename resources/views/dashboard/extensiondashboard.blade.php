@extends('master')
@section('content')
<div class="container-fluid">
  <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-6">
               <div class="card card-success">
                  <div class="card-header">
                     <h3 class="card-title">Surplus Information</h3>
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
                        </div>
                        <thead>
                          <tr>
                           <th style="width: 10px">Sl.No</th>
                           <th>Product Name</th>
                           <th>Quantity</th>
                           <th>FarmGet Price</th>
                           <th>Submitted By</th>
                           </tr>
                        </thead>
                        <tbody>
                          <tr>
                           <td>1</td>
                           <td>Potatoes</td>
                           <td>20 Acres</td>
                           <td>30</td>
                           <td>EO</td>
                          </tr>
                          <tr>
                           <td>2</td>
                           <td>Chilli</td>
                           <td>10 Acres</td>
                           <td>50</td>
                           <td>LUC</td>
                           </tr>
                        </tbody>
                     </table>
                  
               </div>
            </div>
         </div>

         <!-- Demand Info -->
         <div class="col-md-6">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Surplus Statistics</h3>
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
                        </div>
                        <thead>
                          <tr>
                           <th style="width: 10px">Sl.No</th>
                           <th>Product Name</th>
                           <th>Quantity</th>
                           <th>Estimated Production</th>
                           <th>Harvestion Date</th>
                           <th>Year</th>
                           <th>Submitted By</th>
                           </tr>
                        </thead>
                        <tbody>
                          <tr>
                           <td>1</td>
                           <td>Potatoes</td>
                           <td>20 Acres</td>
                           <td>300kg</td>
                           <td>30/07/2020</td>
                           <td>2020</td>
                           <td>EO</td>
                          </tr>
                          <tr>
                           <td>2</td>
                           <td>Chilli</td>
                           <td>10 Acres</td>
                           <td>300kg</td>
                           <td>30/07/2020</td>
                           <td>2020</td>
                           <td>LUC</td>
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
                    <h3 class="card-title">Contact Information</h3>
                  </div>
                  <div class="card-body">
                     <table class="table table-bordered">
                        <div class="form-group row">
                           <div class="col-md-4">
                              Location:
                             <select class="form-control" name="date" id="agency" >
                               <option disabled>Please select Location</option>
                              </select>
                           </div>
                        </div>
                        <thead>
                          <tr>
                           <th style="width: 10px">Sl.No</th>
                           <th>Name</th>
                           <th>Desgination</th>
                           <th>Location</th>
                           <th>Contact Number</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           <td>1</td>
                           <td>Tenzin</td>
                           <td>CA</td>
                           <td>Phaling</td>
                           <td>17594899</td>
                          </tr>
                          <tr>
                           <td>1</td>
                           <td>Norbu</td>
                           <td>VSC</td>
                           <td>Lhuntse Town</td>
                           <td>17594899</td>
                          </tr>
                         </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>   
   </section>
</div>
@endsection