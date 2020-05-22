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
   <form action="{{ url()->current() }}" method="GET">
      <div class="row">
        <div class="col-md-4">
          <select name="crop" class="form-control select2bs4">
            <option value="">--Select Crop--</option>
            @foreach($producttype as $type)
                <option value="{{$type->id}}" {{ Request::get('crop') == $type->id ? 'selected' : '' }}>{{$type->type}}</option>
            @endforeach
            {{-- @foreach ($crops as $crop)
                <option value="{{ $crop->id }}" {{ Request::get('crop') == $crop->id ? 'selected' : '' }}>{{ $crop->name }}</option>
            @endforeach --}}
          </select>
        </div>
        <div class="col-md-5">
          <select name="location" class="form-control select2bs4">
            <option value="">--Select Location--</option>
            @foreach($location as $location)
            <option value="{{$location->location}}" {{ Request::get('location') == $location->id ? 'selected' : '' }}>{{$location->location}}</option>
            @endforeach
            {{-- @foreach ($locations as $location)
                <option value="{{ $location->id }}" {{ Request::get('location') == $location->id ? 'selected' : '' }}>{{ $location->dzongkhag->name . ' - ' . $location->name }}</option>
            @endforeach --}}
          </select>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> </button>
          <a href="{{ url()->current() }}" class="btn btn-danger"><i class="fa fa-undo"></i> </a>
        </div>
      </div>
    </form>
   <!-- Search product -->
 {{-- <form class="form-horizontal" method="POST" action = "{{route('search-surplus')}}">
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
                <option value="{{$type->type}}">{{$type->type}}</option>
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
                <button type="submit" class="btn btn-primary btn-sm float-right" onclick="search()">Search</button>
            </div> 
         </div>
      </div>
   </form> --}}
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
            <h4 class="card-title">Products/Surplus Avaliable </h4>
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
                     <th>Dzongkhag</th> 
                     <th>Gewog</th>
                     <th>Date</th>
                     <th>Locations</th>
                  </tr>
               </thead>
                 @foreach($supplyProducts as $p)
                 <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$p->product->product}}</td>
                     <td>{{$p->gewog->dzongkhag->dzongkhag}}</td>
                     <td>{{$p->gewog->gewog}}</td> 
                     <td>{{$p->transaction->submittedDate}}</td> 
                     <td>{{$p->transaction->location}}</td>  
               </tr>
               @endforeach
            </table>
            </div>
         </div>
      </div>
   </div>
   <!-- product info -->
 <div class="row">
   <div class="col-md-3 mb-3">
     <div class="card product">
        <div class="card-header">
          <h4 class="card-title">Products</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                @foreach($demandProducts as $p)
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
   <!-- contact Info -->
   <div class="col-md-9">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">Extension Officer Information</h4>
         </div> 
         <div class="card-body">
            <table id="product" class="table table-hover table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl.No</th>
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


//  function search() {
//    if(!empty("product")
//       alert('Sorry:Please, Select atleast a option!!!');
//         } else if (!empty("location"))
//          alert('Sorry: You cannot Search the Surplus by Location!!Please,Aslo Select the Product-Type!');
//             }
//         }
//     }
 </script>
 