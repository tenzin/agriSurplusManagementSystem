@extends('master')

@section('content')

{{-- @include('flash-message') --}}

<div class="container-fluid"> 
<div class="card card-info">
<div class="card-header">
<h3 class="card-title">Supply Form</h3>
</div>
<form role="form" method="POST" action="{{route('submit_supply_details')}}">
@csrf
<div class="card-body">
  <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Product Type:<font color="red">*</font></label>
              <select  name="crop_type" id="crop_type" class="form-control select2bs4">
                <option disabled selected value="">Select Product Type</option>
              </select>
          </div> 
          <div class="form-group">
            <label>Quantity:<small>(Quantity should be in kg)</small>&nbsp;<font color="red">*</font></label>
            <input id="quantity" type="text" class="form-control" name="quantity" maxlength="5" placeholder="Enter the Quantity"/>
          </div>

          <div class="form-group">
            <label>Farm gate Price:<small>(Price should be per Kg)</small>&nbsp;<font color="red">*</font></label>
            <input id="price" type="text" class="form-control" name="price"  maxlength="5" placeholder="Enter the Price Per Kg"/>
          </div>
        </div>
        
          <div class="col-md-6">
            <div class="form-group">
              <label>units:<small>(Please select kg)</small>&nbsp;<font color="red">*</font></label>
              <select  name="unit" id="unit" class="form-control select2bs4" >
              <option disabled selected>Select Units</option>
              
              </select>
            </div>
            <div class="form-group">
              <label>Harvest date:&nbsp;<font color="red">*</font></label>
              <input id="pickup_date" type="date" class="form-control" name="pickup_date" />
            </div>

            <div class="form-group">
              <label>Tentative Pickup date:&nbsp;<font color="red">*</font></label>
              <input id="pickup_date" type="date" class="form-control" name="pickup_date" />
            </div>
          </div>
 
  
          <div class="col-md-6">
            
            <div class="form-group">
              <label>Remarks:</label>
              <textarea class="form-control" rows="3" placeholder="Enter Remarks if Any" name="remarks"></textarea>
            </div>
          </div>
        </div>    
               
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Submit</button>
                  </div>
</form>
</div>
</div>


@endsection
   
     












