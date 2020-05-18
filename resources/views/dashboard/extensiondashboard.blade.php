@extends('master')
@section('custom_css')
@include('includes/chart-css')

@endsection
@section('content')

<div class="content">
  <div class="row center">
  <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-title">Total Suppliers Info</h5>
        </div>
        <div class="card-body chart">
          <canvas id="userStats" height="200px"></canvas>
        </div>
      </div>
   </div>
    <div class="col-lg-4">
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
    <div class="col-lg-4">
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
@include('includes/ex-dashboard-stats')
@endsection
