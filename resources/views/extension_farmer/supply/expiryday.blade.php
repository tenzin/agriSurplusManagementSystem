@extends('master')

@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
  <!-- general form elements disabled -->
    <div class="card-header">
      <h2 class="text-center">Enter Batch Details</h2>
    </div>
    <!-- /.card-header -->
    @include('Layouts.message') 
    <div class="card-body">
      <form  method="POST" action={{route('ex-store')}}>
        
        @csrf
        <div class="row">
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label for="expiryday">Expiry Day(s)<font color="red">*</font>:</label>
              <input type="text" class="form-control" name="expiryday" id ="expiryday" maxlength= 2 required/>
              
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
              <input type="date" class="form-control" name="pickupdate" id ="pickupdate" placeholder="yyyy-mm-dd" required>
            </div>
          </div>
          <div class="col-sm-6">
            <!-- textarea -->
            <div class="form-group">
              <label for="location">Location<small>(Pick Up Locations)</small><font color="red">*</font>:</label>
              <input type="text"  class="form-control" name="location" id="location"  required>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
            $(window).on('load', function() {
          console.log('All assets are loaded')
      })
      $(document).ready(function () {
        
          $("#expiryday").keypress(function (e) {
            if (e.which != 46)
            {
              if(isNaN(document.getElementById("expiryday").value))
              {
                alert('Invalid number!!!!');
                document.getElementById("expiryday").style.color = "red";
                return false;
              }
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
              }
            }
            document.getElementById("expiryday").style.color = "black";
            
        });
        $("#phone").keypress(function (e) {
            if (e.which != 46)
            {
              if(isNaN(document.getElementById("phone").value))
              {
                alert('Invalid number!!!!');
                document.getElementById("phone").style.color = "red";
                return false;
              }
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
              }
            }
            document.getElementById("phone").style.color = "black";
        });
        
      }); 
  </script>
@endsection