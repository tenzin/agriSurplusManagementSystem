@extends('master')
@section('custom_css')
@include('includes/chart-css')

@endsection
@section('content')

<div class="content">
  <div class="row center">
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
          <canvas id="surplus" height="150px"></canvas>
        </div>
      </div>
    </div>
   <!-- Surplus vs month -->
            <div class="col-lg-6">
              <div class="card card-chart">
                <div class="card-header">
                 <h5 class="card-category">Surplus vs. Month</h5>
                 <label>Total Surplus Entry in the System</label>
                </div>
              <div class="card-body chart">
                   <canvas id="monthsurplus" height="120px"></canvas>
               </div>
            </div>
          </div>
           <!-- Area of cultivation info -->
            <div class="col-md-6">
               <div class="card cultivation">
                  <div class="card-header">
                     <h3 class="card-title">Area Under Cultivation</h3>
                  </div>
                  <div class="card-body">
                    <table id="area_uc" class="table table-bordered">
                        <div class="row">
                            <div class="col col-md-auto">
                             <label for="product">Products:</label>
                            </div>
                        </div>
                            <div class="col-md-6 mb-3">
                            <select class="custom-select d-block w-100" id="product_name" name="product">
                              <option>Select Product</option>
                                @foreach($product as $pro)
                                  <option value="{{$pro->product}}">{{$pro->product}}</option>
                                  @endforeach
                            </select>  
                          </div>
                        </div>
                      </div>
                        <thead>
                          <tr>
                           <th>Sl.No</th>
                           <th>Product Name</th>
                           <th>Quantity</th>
                           </tr>
                        </thead>
                        @foreach($area_uc as $a)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$a->product->product}}</td>
                        <td>{{$a->quantity}}</td>
                        </tr>
                        @endforeach
                     </table>
                   
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="card info">
                  <div class="card-header">
                     <h3 class="card-title">Commercial Aggregator Details</h3>
                  </div>
                  <div class="card-body">
                     <table class="table table-bordered">
                        <thead>
                          <tr>
                           <th>Sl.No</th>
                           <th>Name</th>
                           <th>Dzongkhag</th>
                           <th>Email</th>
                           <th>Contact No.</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach($user_ca as $ca)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$ca->name}}</td>
                        <td>{{$ca->dzongkhag['dzongkhag']}}</td>
                        <td>{{$ca->email}}</td>
                        <td>{{$ca->contact_number}}</td>   
                      </tr>
                     @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="card cultivation">
                  <div class="card-header">
                     <h3 class="card-title">Cultivation Harvested</h3>
                  </div>
                  <div class="card-body">
                     <table id = "area_hv" class="table table-bordered">
                     <div class="row">
                           <div class="col col-md-auto">
                            <label for="product">Products:</label>
                        </div>
                            <div class="col-md-6 mb-3">
                            <select class="custom-select d-block w-100" id="product" name="product" required>
                              <option>Select Product</option>
                                @foreach($product as $pro)
                                  <option value="{{$pro->product}}">{{$pro->product}}</option>
                                  @endforeach
                            </select>  
                          </div>
                        </div>
                        <thead>
                          <tr>
                           <th>Sl.No</th>
                           <th>Product Name</th>
                           <th>Quantity</th>
                           <th>Harvested Production</th>
                           </tr>
                        </thead>
                        <tbody>
                          @foreach($area_hravested as $hv)
                          <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$hv->product->product}}</td>
                          <td>{{$hv->quantity}}</td>
                          <td>{{$hv->estimated_output.' '.$hv->e_unit->unit}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
    </div>       
</div>
@endsection
@section('custom_scripts')
<script>
  $(document).ready(function() {
 var table = $('#area_uc').DataTable();
 $('#product_name').on('change', function () {
             table.columns(1).search( this.value ).draw();
         });
  });
 
 </script>

<script>
  $(document).ready(function() {
   var table = $('#area_hv').DataTable();
 $('#product').on('change', function () {
             table.columns(1).search( this.value ).draw();
         });
  });
 
 </script>
@include('includes/chart-js')
@include('includes/ex-dashboard-stats')
@endsection
