@extends('master')

@section('content')
<section class="content">
<div class="container-fluid"> 
<div class="card-header">
  <h2 class="text-center mt-1 mb-1 alert aqua">Area Under Cultivation Form</h2>
</div>
<form role="form" method="POST" action="{{route('submit_cultivation_details')}}">
@csrf
<div class="card-body">
  <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Crop Name:<font color="red">*</font></label>
              <select  name="crop" id="crop" class="form-control" required>
                <option disabled selected value="">Select Product Type</option>
                @foreach($product as $p)
                <option value="{{ $p->id }}">{{$p->product.' - '. $p->productType->type}}</option>
                @endforeach
              </select>
          </div> 
          <div class="form-group">
            <label>Estimated Output:&nbsp;<font color="red">*</font></label>
            <input id="output" type="text" class="form-control" name="output"  maxlength="5" placeholder="Enter the Price Per Kg" required/>
          </div>
        </div>
        
          <div class="col-md-4">
            <div class="form-group">
              <label>Quantity/Acerage:<small>(Should be in Acres or number)</small>&nbsp;<font color="red">*</font></label>
               <input id="quantity" type="text" class="form-control" name="quantity" maxlength="5" placeholder="Enter the Quantity" required/>
            </div>
            <div class="form-group">
              <label>Estimated Output Unit:&nbsp;<font color="red">*</font></label>
              <select  name="e_unit" id="e_unit" class="form-control" required>
                <option disabled selected>Select Estimated Units</option>
                @foreach($e_unit as $e)
                <option value="{{ $e->id }}">{{$e->unit}}</option>
                @endforeach
                </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Units:&nbsp;<font color="red">*</font></label>
              <select  name="unit" id="unit" class="form-control" required>
              <option disabled selected>Select Units</option>
              @foreach($c_unit as $c)
                <option value="{{ $c->id }}">{{$c->unit}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Sowing_Month:&nbsp;<font color="red">*</font></label>
              <input id="pickup_date" type="month" class="form-control" name="pickup_date" required/>
            </div>
          </div>
            <div class="col-md-12">
            <div class="form-group">
              <label>Remarks:&nbsp;<small>(Please mention location or address)</small></label>
              <textarea class="form-control" rows="3" placeholder="Enter Remarks if Any" name="remarks"></textarea>
            </div>
          </div>
        </div>            
        </div>
       <center> <button type="submit" class="btn btn-info">Submit</button></center>
   </form>
</div>
</section>

</div>
</div>
@endsection

   
     












