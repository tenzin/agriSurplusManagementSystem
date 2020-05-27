
@extends('master')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">View Extension Surplus</h4>
         </div> 
         <div class="card-body">
            <div class="row">
               <div class="col-md-3 mb-3">
                  <label>SL.No</label>
                  <input type="text" class="form-control" name="id" id ="id" readonly value="{{$supplyProducts->id}}">
                </div> 

                <div class="col-md-3 mb-3">
                <label>Product</label>
                  <input type="text" class="form-control" name="product" id ="product" readonly value="{{$supplyProducts->product->product}}">
                </div> 

                <div class="col-md-3 mb-3">
                 <label>FarmGet Price</label>
                 <div class="input-group">
                 <div class="input-group-prepend">
                     <span class="input-group-text">Nu.</span>
                   <input type="text" class="form-control" name="price" id ="price" readonly value="{{$supplyProducts->price}}">
                </div>
                </div>
                </div>  
                
                <div class="col-md-3 mb-3">
                 <label>Dzongkhag</label>
                  <input type="text" class="form-control" name="dzo" id ="dzo" readonly value="{{$supplyProducts->gewog->dzongkhag->dzongkhag}}">
                </div> 
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                <label>Gewog</label>
                  <input type="text" class="form-control" name="gewog" id ="gewog" readonly value="{{$supplyProducts->gewog->gewog}}">
                </div> 
                <div class="col-md-3 mb-3">
                <label>Location</label>
                  <input type="text" class="form-control" name="location" id ="location" readonly value="{{$supplyProducts->transaction->location}}">
                </div>  

                <div class="col-md-3 mb-3">
                  <label>Contact Number</label>
                  <input type="text" class="form-control" name="contact" id ="contact" readonly value="{{$supplyProducts->transaction->phone}}">
                </div> 
                <div class="col-md-3 mb-3">
                  <label>Submitted Date</label>
                  <input class="form-control" name="date" id ="date" readonly value="{{$supplyProducts->transaction->submittedDate}}">
                </div>  
            </div> 
            <div class="row">
               <div class="col-md-12 mb-3">
                  <label>Remarks</label>
                  <textarea class="form-control" name="remarks" id ="remarks" readonly>{{$supplyProducts->transaction->remark}}</textarea>
                </div> 
            </div>
            <div class="form-group row mb-0">
               <div class="col-md-6 offset-md-6">
                <a class="btn btn-primary btn" href="{{ route('dashboard')}}">Back</a>
            </div>
            <hr> 
        </div> 
        </div>
     </div>
</div>   
@endsection



 
 