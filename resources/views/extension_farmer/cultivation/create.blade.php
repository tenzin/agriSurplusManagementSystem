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
        <div class="col-md-3">
          <div class="form-group">
            <label>Type:<font color="red">*</font></label>
              <select  name="ctype" id="ctype" class="form-control" required>
                <option disabled selected value="">Select Product Type</option>
                @foreach($types as $t)
                <option value="{{ $t->id }}">{{$t->type}}</option>
                @endforeach
              </select>
          </div> 
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label>Product:<font color="red">*</font></label>
              <select  name="product" id="product" class="form-control" required>
                <option value="">Select Product</option>
              </select>
          </div> 
        </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Acres/Number:<font color="red">*</font></label>
               <input id="quantity" type="text" class="form-control" name="quantity" placeholder="Enter the Quantity" required>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Cultivation Units:&nbsp;<font color="red">*</font></label>
              <select  name="unit" id="unit" class="form-control" required>
              <option disabled selected value="">Select Units</option>
              @foreach($c_unit as $c)
                <option value="{{ $c->id }}">{{$c->unit}}</option>
                @endforeach
              </select>
            </div>
          </div>
      </div>
        <div class="row">
           <div class="col-md-4">
             <div class="form-group">
               <label>Estimated Output:&nbsp;<font color="red">*</font></label>
                <input type="number" class="form-control"id="output"  name="output"  maxlength="5" placeholder="Enter Output" required>
              </div> 
            </div>
          <div class="col-md-4">
           <div class="form-group">
              <label>Estimated Output Unit:&nbsp;<font color="red">*</font></label>
              <select  name="e_unit" id="e_unit" class="form-control" required>
                <option disabled selected value="">Select Estimated Units</option>
                @foreach($e_unit as $e)
                <option value="{{ $e->id }}">{{$e->unit}}</option>
                @endforeach
                </select>
            </div>
          </div>
          <div class="col-md-4">
              <label>Sowing Date:&nbsp;<font color="red">*</font></label>
              <input type="date" name="sowing_date" id="sowingdate" class="form-control" required>
          </div>
          
        </div>
          <div class="row">
            <div class="col-md-12">
            <div class="form-group">
              <label>Remarks:&nbsp;<small>(Please mention location or address)</small></label>
              <textarea class="form-control" rows="3" placeholder="Enter Remarks if Any" name="remarks" required></textarea>
            </div>
          </div>
        </div>            
        </div>
       <center> <button type="submit" class="btn btn-info">Submit</button></center>
   </form>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All assets are loaded')
    })
    $(document).ready(function () {
      //alert('hi');
        $("#ctype").on('change',function(e){
            console.log(e);
            var id = e.target.value;
            //alert(id);
            $.get('/json-product_type?product_type=' + id, function(data){
                console.log(data);
                $('#product').empty();
                $('#product').append('<option disabled value="">Select Products</option>');
                $.each(data, function(index, ageproductObj){
                    $('#product').append('<option value="'+ ageproductObj.id +'">'+ ageproductObj.product + '</option>');
                })
            });
        });

        $("#quantity").keypress(function (e) {
            if (e.which != 46)
            {
              if(isNaN(document.getElementById("quantity").value))
              {
                alert('Invalid number!!!!');
                document.getElementById("quantity").style.color = "red";
                return false;
              }
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
              }
            }
            document.getElementById("quantity").style.color = "black";
        });
        
    });
</script>

@endsection



   
     












