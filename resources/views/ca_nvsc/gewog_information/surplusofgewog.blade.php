@extends('master')

@section('content')
{{-- @include('flash-message') --}}
<section class="content">
  <h1 class="text-center mt-1 mb-1 alert aqua">Surplus Details by Location and Gewog(s)</h1>
      {{-- <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Surplus of Gewog(s)</h3>
         </div> --}}
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. No</th>
            <th>Type</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Gewog</th>
            <th>Location</th>
          </tr>
        </thead>
        <tbody>
               @foreach($gewogsupply as $row)
               <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$row->type}}</td>
                  <td>{{$row->product}}</td>                 
                  <td>{{$row->quantity}} {{$row->unit}}</td>            
                  <td>{{$row->gewog}}</td>   
                  <td>{{$row->location}}</td>              
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
   
     












