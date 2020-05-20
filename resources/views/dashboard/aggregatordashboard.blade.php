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
 <form class="form-horizontal" method="POST" action = "{{route('search-surplus')}}">
            @csrf
   <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Search Products...</h4>
     <div class="row">
        <div class="col col-md-auto">
          <label for="product">Product-Type</label>
       </div>
          <div class="col-md-4 mb-3">
          <select class="custom-select d-block w-100" id="type" name="type" required>
            <option>Select ProductType</option>
               @foreach($producttype as $type)
                <option value="{{$type->id}}">{{$type->type}}</option>
                @endforeach
           </select>  
         </div>
        <div class="col col-md-auto">
          <label for="Location">Location</label>
        </div>
          <div class="col-md-4 mb-3">
          <select class="custom-select d-block w-100" id="location" name="location" onchange="getValue();" required>
            <option>Select Location</option>
               @foreach($location as $location)
                <option value="{{$location->id}}">{{$location->location}}</option>
                @endforeach
           </select> 
         </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary btn-sm float-right ">Search</button>
            </div> 
         </div>
      </div>
</form>
   <hr>
  
   <!-- Search Value -->
   <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Selected Location...</h4>
     <div class="row">
        <div class="col-md-4 mb-3">
           <div class="input-group">
             <input type="text" class="form-control" name="place" id ="place">
            </div> 
          <div class="table-responsive">
          <label>List of Products If You Need...</label>           
            <table class="table">
              <tbody>
               {{-- <!-- @foreach($producttype as $t)
                <tr>
                  <td>{{$t->type}}</td>
                </tr>
                @endforeach -->--}}
              </tbody>
            </table>
         </div>
      </div>

   <!-- Product outside Location -->         
    <div class="col-md-8">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">Products Avaliable Based on Locations</h4>
         </div> 
         <div class="card-body">
         <div class="row">
               <div class="col col-md-auto">
                   <label for="date">Date</label>
                </div>
              <div class="col-md-4 mb-3">
                  <div class="input-group">
                     <input type="date" class="form-control" name="date" id ="date">
                  </div>
               </div>
            </div>
            <table id="product" class="table table-hover table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>Product</th>
                     <th>Product-Type</th>
                     <th>Gewog</th>
                     <th>Location</th>
                     <th>Date</th>
                  </tr>
               </thead>
                 <!-- @foreach($users_data as $ud)
                 <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$ud->name}}</td>
                     <td>{{$ud->gewog['gewog']}}</td> 
                     <td>{{$ud->gewog['gewog']}}</td>  
               </tr>
               @endforeach -->
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
            <table id="example1" class="table-sm table-hover table-bordered table-striped">
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
       $('#date').on('change', function () {
          table.columns(4).search( this.value ).draw();
   });

 });

 function getValue(){
    var name = document.getElementById("location");
    var displayvalue= name.options[name.selectedIndex].text;
    document.getElementById("place").value=displayvalue;
 }


 function search() {
      
      var loc = document.getElementById("location").value;
     // alert(refNo);
      $.get('/json-surplus-exist?refNo=' + refNo, function(data){
        if(data == null || data ==''){
            alert('Sorry:Please, Select atleast a option!!!');
        } elseif {
         alert('Sorry: You cannot Search the Surplus by Location!!Please,Aslo Select the Product-Type!');
            //show some type of message to the user
            if (confirm('Are you sure you want to submit your demand list?. Once you submit, you cannot add or delete or update.'))  {
              var id = document.getElementById("refnumber").value;
              $.get('/json-submit-surplus?ref_number=' + id, function(data){
                window.location = "/national/";
              });
            }
        }
      });
      }
 </script>
