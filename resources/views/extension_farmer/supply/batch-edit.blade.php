@extends('master')

@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
  <!-- general form elements disabled -->
  {{-- <div class="card card-warning"> --}}
    <div class="card-header">
      <h2 class="text-center">Update Batch Details</h2>
    <h5 class="text-center">Ref No.&nbsp;&nbsp;<b>{{$data->refNumber}}</b></h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form  method="POST" action={{route('batch-update',$data->id)}}>
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label for="expiryday">Expiry Date(s):</label>
              <input type="date" class="form-control" name="expiryday" id ="expiryday" value="{{$data->expiryDate }}">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="phone">Phone<font color="red">*</font>:</label>
              <input type="text"  class="form-control" name="phone" id="phone"  maxlength= 8 value="{{$data->phone}}" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <!-- textarea -->
            <div class="form-group">
              <label for="pickupdate">Pickup<font color="red">*</font>:</label>
              <input type="date" class="form-control" name="pickupdate" id ="pickupdate" value="{{$data->pickupdate ?? ''}}" required>
            </div>
          </div>
          <div class="col-sm-6">
            <!-- textarea -->
            <div class="form-group">
              <label for="location">Location<font color="red">*</font>:</label>
              <input type="text"  class="form-control" name="location" id="location" value="{{ $data->location ?? ''}}" required>
            </div>
          </div>
        </div>
          <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="remark">Remark:</label>
              <textarea type="text" class="form-control" name="remark" id ="remark" rows="3" cols="2" required>{{ $data->remark ?? ''}}</textarea>
            </div>
          </div>
        </div>
        <hr> 
        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-6">
            <button type="submit" class="btn btn-success">Update</button>
          </div>
           </div>
        
       </div>
        <!-- input states -->
      </form>
    </div>
    <!-- /.card-body -->
  </div>

@endsection