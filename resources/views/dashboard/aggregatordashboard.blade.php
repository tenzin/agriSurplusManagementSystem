@extends('master')

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- CA info-->
      <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-info bg-info">
            <div class="inner">
               <p>Commercial Aggregator</p>
               <h3>{{$ca}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-person-add"></i>
            </div>
         </div>
      </div>
      <!-- LUC info-->
      <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-primary bg-primary">
            <div class="inner">
               <p>Land User Certificate</p>
               <h3>{{$luc}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-person-add"></i>
            </div>
         </div>
      </div>
       <!-- EO info-->
       <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-secondary bg-success">
            <div class="inner">
               <p>Extension Officer</p>
               <h3>{{$ex}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-person-add"></i>
            </div>
         </div>
      </div>
      <!-- Farmer group info-->
      <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-dark bg-warning">
            <div class="inner">
               <p>Farmer Groups</p>
               <h3>{{$farmer}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-person-add"></i>
            </div>
         </div>
      </div>
   </div>
   <hr>

   <form action="{{ url()->current() }}" method="GET">
   <div class="row">
         <div class="col-md-4 mb-3">
          <select name="crop" class="form-control">
            <option value="">Select Crop Type</option>
            @foreach($producttype as $type)
                <option value="{{$type->id}}" {{ Request::get('crop') == $type->id ? 'selected' : '' }}>{{$type->type}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> </button>
          <a href="{{ url()->current() }}" class="btn btn-danger"><i class="fa fa-undo"></i> </a>
        </div>

         <div class="col-md-auto">
            <label>FilterBy Date:</label>
         </div>
         <div class="col-md-3 mb-3">
            <div class="input-group">
               <input type="date" class="form-control" name="date" id ="date">
            </div>
         </div>
         </div>
      </div>
    </form> 
   <hr>

   <!-- Product Search details -->         
    <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">Products/Surplus Avaliable </h4>
         </div> 
         <div class="card-body">
            <table id="example1" class="table table-hover table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>Product</th>
                     <th>Dzongkhag</th> 
                     <th>Gewog</th>
                     <th>SubmittedDate</th>
                     <th>Action</th>
                  </tr>
               </thead>
                 @foreach($supplyProducts as $row)
                 <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$row->product->product}}</td>
                     <td>{{$row->gewog->dzongkhag->dzongkhag}}</td>
                     <td>{{$row->gewog->gewog}}</td> 
                     <td>{{$row->transaction->submittedDate}}</td> 
                     <td> <a href="{{route('exsurplus-view',$row->id)}}">
                    <i class="fa fa-eye" aria-hidden="true"> </i>View</a></td>  
                 </tr>
                @endforeach
            </table>
         </div>
      </div>

   <!-- product Type info -->
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
   <!-- contact Info -->
   <div class="col-md-9">
      <div class="card contact">
         <div class="card-header">
            <h4 class="card-title">Extension Officer Information</h4>
         </div> 
         <div class="card-body">
            <table id="details" class="table table-hover table-bordered table-striped">
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

@section('custom_scripts')

<script>
$(document).ready(function() {
   var table =  $('#example1').DataTable();
       $('#date').on('change', function () {
          table.columns(4).search( this.value ).draw();
   });
});
</script>
 @endsection
 
 