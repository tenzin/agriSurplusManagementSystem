
@extends('master')
@section('content')

<div class="container">
    <h2 class="text-primary text-center">Surplus List </h3>
    <center><p class="text-muted">{{$msg}}</p></center>
    @if($user->role_id==4 || $user->role_id==5)
    
    <br>

    <div class="row" >
         
        <div class="col-md-6">
            Date:<input placeholder="Date" class="form-control" type="text" onfocus="(this.type='date')" id="date" name="date">
            {{-- Date:<input type="date" class="form-control" name="date" id="date" > --}}
        </div>
          <div class="col-md-6">
            Gewog:<select class= "form-control select2bs4" name="location" id="location" >
                <option disabled>Please select location</option>
                <option selected value="">All</option>
               @foreach($location as $location)
                  <option value="{{$location->gewog}}">{{$location->gewog.' - '.$location->dzongkhag->dzongkhag}}</option>
                 @endforeach
              </select>
          </div>
    </div>
      <br>
    <table id= "example1" class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
        <th scope="col">#</th>
        {{-- <th scope="col">Referance No.</th> --}}
        {{-- <th scope="col">Product Type</th> --}}
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Pick Up Date</th>
        <th scope="col">Gewog</th>
        <th>Action</th>
        </tr>
    </thead>
        <tbody>
          @foreach($product as $row)
          <tr>
             <td>{{$loop->iteration}}</td>
             {{-- <td>{{$row->type}}</td> --}}
             <td>{{$row->product}}</td>
             <td>{{$row->quantity.' '.$row->unit}}</td>
             <td>Nu. {{$row->price}}</td>
             {{-- <!-- <td>{{$row->harvestDate}}</td> --> --}}
             <td>{{$row->tentativePickupDate}}</td>
          <td>{{$row->gewog}}</td>

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
             </tr>
        @endforeach
    </tbody>
    </table>

    @else

    <table id= "example1" class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
            <th scope="col">#</th>
            {{-- <th scope="col">Referance No.</th> --}}
            {{-- <th scope="col">Product Type</th> --}}
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Pick Up Date</th>
            <th>Action</th>
            </tr>
        </thead>
            <tbody>
              @foreach($product as $row)
              <tr>
                 <td>{{$loop->iteration}}</td>
                 {{-- <td>{{$row->type}}</td> --}}
                 <td>{{$row->product}}</td>
                 <td>{{$row->quantity.' '.$row->unit}}</td>
                 <td>Nu. {{$row->price}}</td>
                 {{-- <!-- <td>{{$row->harvestDate}}</td> --> --}}
                 <td>{{$row->tentativePickupDate}}</td>
    
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
            table.columns(5).search( this.value ).draw();
        });

$('#date').on('change', function () {
  table.columns(4).search( this.value ).draw();
});
 });

</script>
@endsection












