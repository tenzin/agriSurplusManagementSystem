@extends('master')

@section('content')
{{-- @include('flash-message') --}}
<section class="content">
<div class="container-fluid"> 
<div class="card card-info">
<div class="card-header">
<h3 class="card-title">Cultivation Form</h3>
</div>
<form role="form" method="POST" action="{{route('submit_cultivation_form')}}">
{{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> --}}
@csrf 
                <div class="card-body">
                  <div class="form-group row">
                    <label for="crop_type" class="col-sm-2 col-form-label">Product Type:<font color="red">*</font></label>
                    <div class="col-sm-10">
                      <select  name="crop_type" id="crop_type" class="form-control select2bs4">
                      <option disabled selected value="">Select Product Type</option>
                      
                      </select>
                    </div>
                  </div>    
                  <div class="form-group row">
                    <label for="crop_type" class="col-sm-2 col-form-label">Remarks:</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="reason" rows="2"></textarea>
                    </div>
                  </div>    
                </div>
                <div class="card-footer">
                <a href="{{ url()->current() }}" class="btn btn-danger float-right">Reset</a>
                <button type="submit" class="btn btn-info float-right">Next</button>
                </div>
</form>
</div>
</div>
</section>

</div>
</div>
@endsection
   
     












