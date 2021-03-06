
@extends('master')
@section('content')

<div class="container">
    
    @if($user->role_id==4 || $user->role_id==5)
    <h2 class="text-primary text-center">Surplus List </h3>
        <center><p class="text-muted">{{$msg}} From Extensions/Land User/Farmers Group</p></center>
    <br>

    <div class="row justify-content-center" >
         
        <div class="col-md-4">
            {{-- Date:<input placeholder="Date" class="form-control" type="text" id="date" name="date"> --}}
            Pick Up Date:<input type="date" class="form-control" name="date" id="date" >
        </div>
          <div class="col-md-4">
            Gewog:<select class= "form-control select2bs4" name="location" id="location" >
                <option disabled>Please select location</option>
                <option selected value="">All</option>
               @foreach($location as $locations)
                  <option value="{{$locations->gewog}}">{{$locations->gewog.' - '.$locations->dzongkhag->dzongkhag}}</option>
                 @endforeach
              </select>
          </div>
    </div>
      <br>
    <table id= "example1" class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
        <th scope="col">Sl.No</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price per Unit</th>
        <th scope="col">PickUp Location</th>
        <th scope="col">Pick Up Date</th>
        <th scope="col">Gewog-Dzongkhga</th> 
        <th scope="col">Phone</th>
        <th scope="col">Remarks</th>  
      
       
        </tr>
    </thead>
        <tbody>
          @foreach($product as $row)
          <tr>
             <td>{{$loop->iteration}}</td>
             <td>{{$row->product->product}}</td>
             <td>{{$row->quantity.' '.$row->unit->unit}}</td>
             <td>Nu. {{$row->price}}</td>
             <td>{{$row->transaction->location}}</td>
             <td>{{$row->transaction->pickupdate}}</td>
             <td>{{$row->gewog->gewog.' '.$row->gewog->dzongkhag->dzongkhag}}</td>
             <td>{{$row->transaction->phone}}</td>
             <td>{{$row->transaction->remark}}</td>
             </tr>
        @endforeach
    </tbody>
    </table>

    @else
    <h2 class="text-primary text-center">Surplus List </h3>
        <center><p class="text-muted">{{$msg}}</p></center>
    <table id= "example1" class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">PickUp Location</th>
            <th scope="col">Pick Up Date</th>
            <th>Action</th>
            <th>Update</th>
            </tr>
        </thead>
            <tbody>
              @foreach($product as $row)
              <tr>
                 <td>{{$loop->iteration}}</td>
                 <td>{{$row->product}}</td>
                 <td>{{$row->quantity.' '.$row->unit}}</td>
                 <td>Nu. {{$row->price}}</td>
                <td>{{$row->location}}</td>
                 <td>{{$row->pickupdate}}</td>
    
                 <td> 
                    @can('extension_edit_surplus_details') 
                    <a href="{{route('editi-submitted',$row->id)}}">
                        <i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                    
                    &nbsp;
                    @endcan
    
                    @can('extension_view_surplus_details')
                    <a href="{{route('surplus-view-detail',$row->id)}}">
                        <i class="fa fa-eye" aria-hidden="true"></i>View</a>
                    @endcan
                 </td>  
                 <td>
                    <button type="button" class="btn btn-block bg-gradient-warning btn-xs" style="width:2cm;" onclick="return confirm('Are you sure all Quantity are Taken??');">
                        <a href="{{route('updatee',$row->id)}}" >All Taken</a>
                        </button>
                    
                </td> 
                 </tr>
            @endforeach
        </tbody>
        </table>

      @endif

</div>
@endsection
   
     
@section('custom_scripts')

<script>
 $(document).ready(function() {

var table =  $('#example1').DataTable();
$('#location').on('change', function () {
            table.columns(6).search( this.value ).draw();
        });

$('#date').on('change', function () {
  table.columns(5).search( this.value ).draw();
});
 });

</script>
@endsection












