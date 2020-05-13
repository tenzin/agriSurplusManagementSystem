@extends('master')

@section('content')
{{-- @include('flash-message') --}}
<section class="content">
  <h1 class="text-center mt-1 mb-1 alert aqua">Surplus Details Information</h1>
      {{-- <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Surplus Details</h3>
         </div> --}}
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. no</th>
            <th>Product</th>
            <th>Product Type</th>
            <th>Quantity</th>
            <th>CostPrice</th>
            <th>Tentitive Pickup Date</th>
            <th>Harvest Date</th>
            <th>Remarks</th>
            <th>Status</th>
            <th>Action</th>
          
          </tr>
        </thead>
        <tbody>
               @foreach($product as $row)
               <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$row->product->product}}</td>
                  <td>{{$row->product->productType->type}}</td>
                  <td>{{$row->quantity.' '.$row->unit->unit}}</td>
                  <td>Nu. {{$row->price}}</td>
                  <td>{{$row->tentativePickupDate}}</td>
                  <td>{{$row->harvestDate}}</td>
                  <td>{{$row->remarks}}</td>
                  <td>{{$row->status}}</td>
                  <td></td>
                
               </tr>
               @endforeach
        </tbody>

          
      </table>
    </div>
</div>  
</section>

</div>
</div>
@endsection
   
     












