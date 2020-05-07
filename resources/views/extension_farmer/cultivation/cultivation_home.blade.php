<!-- Content Wrapper. Contains page content -->
@extends('master')
    
@section('content')
{{-- @include('flash-message') --}}
<section class="content">
      {{-- <div class="card card-info"> --}}
        <h1 class="text-center mt-1 mb-1 alert aqua">Crops Under Cultivation Details</h1>
         {{-- <div class="card-header">
            <h3 class="card-title">Crops Under Cultivation Details</h3>
         </div> --}}
  
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. no</th>
            <th>Crop_name</th>
            <th>Quantity/Acerage & Unit</th>
            <th>Sowing_Date</th>
            <th>Estimated Output & Unit</th>
            <th>Remarks</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cultivations as $c)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$c->product->product}}</td> 
            <td>{{$c->quantity.' - '.$c->c_unit->unit}}</td>
            <td>{{$c->sowing_date}}</td> 
            <td>{{$c->estimated_output.' - '. $c->e_unit->unit}}</td> 
            <td>{{$c->remarks}}</td>
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
   
     












