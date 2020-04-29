@extends('master')

@section('content')
{{-- @include('flash-message') --}}
<section class="content">
<div class="container-fluid">
<form role="form" method="POST" action="{{route('submit_cultivation_details')}}">
  @csrf
{{-- <input type="hidden" name="cultivation_id" value="{{ $cultivation_id }}">
<input type="hidden" name="tbl_cultivation_id" value="{{ $tbl_cultivation_id }}"> --}}

<div class="card card-info">
  <div class="card-header">
      Product Name:
    {{-- <h3 class="card-title">Cultivation Information:{{ $cropName }}</h3> --}}
  </div>
  <div class="card-body">
        <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Quantity/Acerage:<small>(Should be in Acres or number)</small>&nbsp;<font color="red">*</font></label>
                  <input id="acerage" type="text" class="form-control" name="acerage" maxlength="3"  placeholder="Enter the total acres under cultivation"/>
                </div>
                <div class="form-group">
                    <label>Estimated Output:&nbsp;<font color="red">*</font></label>
                    {{-- <textarea class="form-control" rows="3" placeholder="Enter Remarks if Any" name="remarks"></textarea> --}}
                    <input id="output" type="text" class="form-control" name="output" placeholder="Enter estimated output"/>
                  </div>
              </div>
              
                <div class="col-md-6">
                  <div class="form-group">
                    <label>units:<small>(Please select units)</small>&nbsp;<font color="red">*</font></label>
                    <select  name="unit" id="unit" class="form-control select2bs4" >
                    <option disabled selected value="">Select Units</option>
                    
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Sowing_date:&nbsp;<font color="red">*</font></label>
                    <input id="sowing_date" type="month" class="form-control" name="sowing_date"/>
                  </div>
                </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>remarks:</label>
                  <textarea class="form-control" rows="3" placeholder="Enter Remarks if Any" name="remarks"></textarea>
                  {{-- <input id="remarks" type="text" class="form-control" name="remarks" placeholder="Enter remarks IF ANY"/> --}}
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


  
   
     













