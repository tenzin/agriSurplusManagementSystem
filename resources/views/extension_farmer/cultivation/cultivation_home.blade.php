<!-- Content Wrapper. Contains page content -->
@extends('master')
    
@section('content')
<section class="content">
      <h1 class="text-center mt-1 mb-1 alert aqua">Crops Under Cultivation Details</h1>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl.No</th>
            <th>Crop_Name</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Update</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cultivations as $c)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$c->product->product}}</td> 
            <td>{{$c->quantity.' '.$c->c_unit->unit}}</td>
            <td>@if($c->status == '1')<span class="label">Harvested</span>
              @else<span class="label">Under Cultivation</span>@endif </td>
             <td> 
              @if($c->status == 0)                  
              <button type="button" class="btn btn-block bg-gradient-warning btn-xs" style="width:2cm;">
                <a href="{{route('update_cultivation_status',$c->id)}}" >Harvested</a>
                </button>
              @else
              <button type="button" class="btn btn-block bg-gradient-info btn-xs" style="width:2cm;" disabled>
                Harvested
              </button>
              @endif 
             </td>
              <td>
              @if($c->status == 0)
                <a href="{{route('cultivation-view',$c->id)}}">
                    <i class="fa fa-eye" aria-hidden="true"></i>View</a>
                <a href="{{route('cultivation-edit',$c->id)}}">
                  <i class="fa fa-edit" aria-hidden="true"> </i> Edit</a>
                 &nbsp;
                 <a onclick="return confirm('Are you sure want do Delete Permanently?')" href="{{route('cultivation-delete',$c->id)}}" class="text-danger">
                   <i class="fa fa-trash" aria-hidden="true"> </i> Remove</a>
                @else
                <a href="{{route('cultivation-view',$c->id)}}">
                    <i class="fa fa-eye" aria-hidden="true"></i>View</a>
                     &nbsp;
                 {{-- <a onclick="return confirm('Are you sure want do Delete Permanently?')" href="{{route('cultivation-delete',$c->id)}}" class="text-danger">
                   <i class="fa fa-trash" aria-hidden="true"> </i> Remove</a> --}}
                @endif
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
   
     












