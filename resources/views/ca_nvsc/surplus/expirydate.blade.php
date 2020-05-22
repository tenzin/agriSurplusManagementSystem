@extends('master')

@section('content')

<div class="row justify-content-center">
  <div class="col-md-6">
    <!-- general form elements disabled -->
    {{-- <div class="card card-warning"> --}}
      <div class="card-header">
        <h2 class="text-center">Enter Batch Details</h2>
        {{-- <h3 class="card-title">General Elements</h3> --}}
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form  method="POST" action={{route('store')}}>
          @csrf
          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label for="expiryday">Expiry Day(s):</label>
                <input type="number" class="form-control" name="expiryday" id ="expiryday" value="{{ $days ?? '0' }}">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="phone">Phone<font color="red">*</font>:</label>
                <input type="text"  class="form-control" name="phone" id="phone"  maxlength= 8 value="{{ $trans->phone ?? ''}}" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <!-- textarea -->
              <div class="form-group">
                <label for="pickupdate">Pickup<font color="red">*</font>:</label>
                <input type="date" class="form-control" name="pickupdate" id ="pickupdate" value="{{$trans->pickupdate ?? ''}}" required>
              </div>
            </div>
            <div class="col-sm-6">
              <!-- textarea -->
              <div class="form-group">
                <label for="location">Location<font color="red">*</font>:</label>
                <input type="text"  class="form-control" name="location" id="location" value="{{ $trans->location ?? ''}}" required>
              </div>
            </div>
          </div>
            <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="remark">Remark:</label>
                <textarea type="text" class="form-control" name="remark" id ="remark" rows="3" cols="2" required>{{ $trans->remark ?? ''}}</textarea>
              </div>
            </div>
          </div>
          <hr> 
          <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-6">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
             </div>
          
         </div>
          <!-- input states -->
        </form>
      </div>
      <!-- /.card-body -->
    </div>
  

{{-- <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="../../index2.html"><b>Expiry_</b>Day</a>
    </div>
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
         <!-- lockscreen image -->
    <div class="lockscreen-image">
        <img src="{{asset('images/logo.jpg')}}" alt="User Image">
      </div>
      <!-- lockscreen credentials (contains the form) -->
      <form class="lockscreen-credentials" method="POST" action={{route('store')}}>
        @csrf
        <div class="input-group">
          
          <input type="text" class="form-control" placeholder="Please enter expiry day" maxlength="2" name="expirydate" id="expirydate" required/>
  
          <div class="input-group-append">
            <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
          </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->
  
    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
      Enter Expiry Day for this batch of product
    </div>
  </div> --}}
@endsection