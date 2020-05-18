
@extends('master')   
@section('content')

<section class="content">
     <h1 class="text-center mt-1 mb-1 alert aqua">View Crops Under Cultivation</h1>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl.No</th>
            <th>Crop_name</th>
            <th>Quantity/Acerage & Unit</th>
            <th>Estimated Output & Unit</th>
            <th>Sowing_Date</th>
            <th>Status</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$cultivation->id}}</td>
            <td>{{$cultivation->product->product}}</td> 
            <td>{{$cultivation->quantity.' - '.$cultivation->c_unit->unit}}</td>
            <td>{{$cultivation->estimated_output.' - '. $cultivation->e_unit->unit}}</td> 
            <td>{{$cultivation->sowing_date}}</td> 
            <td> @if($cultivation->status == '1')<span class="label">Harvested</span>
                @else<span class="label">Under Cultivation</span>@endif 
            </td>
            <td>{{$cultivation->remarks}}</td>     
          </tr>
         </tbody>
         </table>
         <hr>           
         <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
                 <a class="btn btn-primary btn-sm" href="{{ route('view_cultivation_details')}}">Go back</a>
            </div>
      </div>
    </div>
</section>
@endsection
   
     












