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
        @include('Layouts.message') 
        <form  method="POST" action={{route('store')}}>
          @csrf
          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label for="expiryday">Expiry Day(s)<font color="red">*</font>:</label>
                <input type="number" class="form-control" name="expiryday" id ="expiryday" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="phone">Phone<small>(Contact number)</small><font color="red">*</font>:</label>
                <input type="text"  class="form-control" name="phone" id="phone"  maxlength= 8 required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <!-- textarea -->
              <div class="form-group">
                <label for="pickupdate">Pickup Date<font color="red">*</font>:</label>
                <input type="date" class="form-control" name="pickupdate" id ="pickupdate" required>
              </div>
            </div>
            <div class="col-sm-6">
              <!-- textarea -->
              <div class="form-group">
                <label for="location">Location<small>(Pick Up Locations)</small><font color="red">*</font>:</label>
                <input type="text"  class="form-control" name="location" id="location" maxlength= 10 required>
              </div>
            </div>
          </div>
            <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="remark">Remark:</label>
                <textarea type="text" class="form-control" name="remark" id ="remark" rows="3" cols="2" required></textarea>
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
 
@endsection