@extends('master')

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- CA info-->
      <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-info">
            <div class="inner">
               <p>Commercial Aggregator</p>
               <h3>{{$ca}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
      <!-- LUC info-->
      <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-primary">
            <div class="inner">
               <p>Land User Certificate</p>
               <h3>{{$luc}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
       <!-- EO info-->
       <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-secondary">
            <div class="inner">
               <p>Extension Officer</p>
               <h3>{{$ex}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
      <!-- Farmer group info-->
      <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-dark">
            <div class="inner">
               <p>Farmer Groups</p>
               <h3>{{$farmer}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
   </div>
   <hr>

   <!-- Search product -->
   <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Search Products NearBy You..</h4>
     <div class="row">
        <div class="col-md-4 mb-3">
          <label for="product">Product-Type</label>
          <select class="custom-select d-block w-100" id="type" name="type" required>
            <option>Select Product-Type</option>
               @foreach($producttype as $type)
                <option value="{{$type->id}}">{{$type->type}}</option>
                @endforeach
           </select>  
         </div>
        <div class="col-md-4 mb-3">
          <label for="Location">Location</label>
          <select class="custom-select d-block w-100" id="location" name="location" required>
            <option>Select Location</option>
          </select>
         </div>
         <div class="col-md-4 mb-3">
              <label for="date">Date</label>
              <div class="input-group">
               <input type="date" class="form-control" name="date" id ="date">
              </div>
          </div>
      </div>
   <hr>

   <!-- Search Value -->
   <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Products For You..</h4>
     <div class="row">
        <div class="col-md-4 mb-3">
          {{--  <!-- @if($location->$type-type)<span class="label">{{$type->type}}</span>
                @else<span class="label">Location Name</span>
            @endif -->
          <!-- <label for="product">Products</label> -->--}}
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

   <!-- Product outside Location -->
    <div class="col-md-8">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Products Avaliable Outside Your Location</h3>
         </div>
         <div class="card-body">
            <table id="product" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>Product</th>
                     <th>Product-Type</th>
                     <th>Location</th>
                     <th>Date</th>
                  </tr>
               </thead>
                 @foreach($users_data as $ud)
                 <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$ud->name}}</td>
                     <td>{{$ud->gewog['gewog']}}</td> 
                     <td>{{$ud->gewog['gewog']}}</td>  
               </tr>
               @endforeach
            </table>
            </div>
         </div>
      </div>
   </div>

   <!-- contact Info -->
   <hr>
    <div class="col-md-12">
      <div class="card">
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
                  </tr>
               </thead>
                 @foreach($users_data as $ud)
                 <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$ud->name}}</td>
                     <td>{{$ud->gewog['gewog']}}</td>
                     <td>{{$ud->email}}</td>
                     <td>{{$ud->contact_number}}</td>   
               </tr>
               @endforeach
            </table>
            </div>
         </div>
      </div> 
@endsection

<script>
$(document).ready(function() {

var table =  $('#product').DataTable();
$('#type').on('change', function () {
            table.columns(2).search( this.value ).draw();
        });
$('#location').on('change', function () {
            table.columns(3).search( this.value ).draw();
        });
$('#date').on('change', function () {
            table.columns(4).search( this.value ).draw();
   });

 });
 </script>