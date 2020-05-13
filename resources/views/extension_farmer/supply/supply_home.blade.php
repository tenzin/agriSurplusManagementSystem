
@extends('master')
@section('content')

<section class="content">
      {{-- <div class="card card-info"> --}}
        <h1 class="text-center mt-1 mb-1 alert aqua">Surplus List(Submitted)</h1>
         {{-- <div class="card-header">
            <h3 class="card-title">Surplus Details</h3>
         </div> --}}
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. no</th>
            <th>Product Type</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Farm gate Price</th>
            <th>Harvest Date</th>
            <th>Tentitive Pickup Date</th>
            <th>Actions</th>
          </tr>
        </thead> 
        <tbody>
          @foreach($product as $row)
          <tr>
             <td>{{$loop->iteration}}</td>
             <td>{{$row->product}}</td>
             <td>{{$row->type}}</td>
             <td>{{$row->quantity.' '.$row->unit}}</td>
             <td>Nu. {{$row->price}}</td>
             <td>{{$row->harvestDate}}</td>
             <td>{{$row->tentativePickupDate}}</td>
             <td> <a href="{{route('surplus-view-detail',$row->id)}}">
                <i class="fa fa-eye" aria-hidden="true"></i>View</a>
                &nbsp;
                <a href="{{route('edit-submitted',$row->id)}}">
                <i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
             </td>  
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
   
     












