@extends('master')

@section('content')
{{-- @include('flash-message') --}}
<section class="content">
<div class="container-fluid">
<form role="form" method="POST" action="{{route('submit_demand_details')}}">
@csrf
{{-- <input type="hidden" name="demand_id" value="{{ $demand_id }}">
<input type="hidden" name="tbl_demand_id" value="{{ $tbl_demand_id }}">
<input type="hidden" name="tbl_demand_crop_id" value="{{ $tbl_demand_crop_id }}"> --}}

<div class="card card-info">
  <div class="card-header">
      Product Name:
    {{-- <h3 class="card-title">Demand Information: {{ $cropName }}</h3> --}}
  </div>
  <div class="card-body">
        <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Quantity:<small>(Quantity should be in kg)</small>&nbsp;<font color="red">*</font></label>
                  <input id="quantity" type="text" class="form-control" name="quantity" maxlength="5"  placeholder="Please enter the quantity"/>
                </div>
                <div class="form-group">
                  <label>Tentative Cost Price:<small>(Cost Price should be per Kg)</small>&nbsp;<font color="red">*</font></label>
                  <input id="price" type="text" class="form-control" name="price"  placeholder="Please enter the price per Kg"/>
                </div>
              </div>
              
                <div class="col-md-6">
                  <div class="form-group">
                    <label>units:<small>(Please select kg)</small>&nbsp;<font color="red">*</font></label>
                    <select  name="unit" id="unit" class="form-control select2bs4" ]>
                    
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tentative Supply date:&nbsp;<font color="red">*</font></label>
                    <input id="datepicker" type="date" class="form-control" name="date"/>
                  </div>
                  
                </div>
       
        
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Remarks:</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Remarks if Any" name="remarks"></textarea>
                  </div>
                </div>
        
  </div>
<!-- /.card-body -->

</div>
<div class="card-footer">
<button type="submit" class="btn btn-info float-right">Submit</button>
</div>
</form>
</div>
</div>
</section>
</div>
</div>
@endsection

  
   
     













