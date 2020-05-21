@extends('master')

@section('content')
<style>
   select[readonly] option, select[readonly] optgroup {
        display: none;
    }
</style>
<div class="container">
<div class="py-2 text-center">
  <h3>Surplus Submitted <i class="fa fa-edit text-primary"></i> </h3>
  @foreach($demands as $demand)
  <h5>Ref. No: <b>{{$demand->refNumber}}</b></h5>
  <hr>
  @endforeach
</div>
<div class="row justify-content-center">
<form method="POST" action="{{route('update-submitted',$demand->id)}}" >
@csrf
<div class="form-group row">
  <input type="hidden" id="refno" name="refno" value="{{$demand->refNumber}}"/>
  <div class="col-md-12 order-md-1">
    <h4 class="mb-3">Product details</h4>
    <form class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-4 mb-3">
          <label for="country">Product Type*</label>
          <select class="custom-select d-block w-100" id="producttype" name="producttype" >
            <option readonly value="">Choose...</option>
            @foreach($products as $producttype)
              <option value="
                {{$producttype->id}}" {{($demand->productType_id == $producttype->id) ? 'selected' : '' }}>
                {{$producttype->type}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            Please select a valid productType.
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="state">Product*</label>
          <select class="custom-select d-block w-100" id="product" name="product" >
            <option readonly value="">Choose...</option>
            @foreach($produce as $row)
              <option value="
                {{$row->id}}" {{($demand->product_id == $row->id) ? 'selected' : '' }}>
                {{$row->product}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            Please provide a valid Product.
          </div>
        </div>
        <div class="col-md-4 mb-3">
              <label for="unit">Price* (tentative)</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Nu.</span>
                  </div>
                  <input type="text" value="{{ $demand->price}}" class="form-control" name="price" id="price" required>
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
              </div>
          </div>
      </div>
      <div class="form-group row">
      <div class="col-md-4 mb-3">
              <label for="unit">Status:<font color="red">*</font></label>
              <div class="input-group">
                  <select class="custom-select d-block w-100" id="status" name="status">
                    {{-- <option required value="A" {{($demand->status == 'A') ? 'selected' : '' }}>
                      Required</option>
                      <option required value="S" {{($demand->status == 'S') ? 'selected' : '' }}>
                      Supplied</option> --}}
                      <option required value="T" {{($demand->status == 'T') ? 'selected' : '' }}>
                      Transaction</option>
                  </select>
                  <div class="invalid-feedback" style="width: 100%;">
                  Status is required.
                  </div>
              </div>
          </div>    
          <div class="col-md-4 mb-3">
              <label for="qty">Taken Quantity:<font color="red">*</font></label>
              <input type="hidden" id="hqty" name="hqty" value="{{$demand->quantity}}"/>
              <input type="text" value="{{ $demand->quantity}}" class="form-control" name="quantity" id="quantity" required>
              <div class="invalid-feedback">
                  Please enter Quantity.
              </div>
          </div>
          <div class="col-md-4 mb-3">
              <label for="unit">Unit*</label>
              <div class="input-group">
                  <select class="custom-select d-block w-100" id="unit" name="unit" required>
                  <option readonly value="">Choose...</option>
                  @foreach($units as $row)
                    <option value="
                      {{$row->id}}" {{($demand->unit_id == $row->id) ? 'selected' : '' }}>
                      {{$row->unit}}</option>
                  @endforeach
                  </select>
                  <div class="invalid-feedback" style="width: 100%;">
                  Unit is required.
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="unit">Hravest Date</label>
          <div class="input-group">
             
              <input type="text" value="{{ $demand->harvestDate}}" class="form-control" name="harvestDate" id="harvestDate" required>
              
          </div>
      </div>
      </div>

     

      <hr>
      <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-success btn-sm">Update</button>
                 <a class="btn btn-primary btn-sm" href="{{ route('view_supply_details')}}">Go back</a>
            </div>
      </div>
    </form>
  </div>
  </div>
</div>
@endsection
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All assets are loaded')
    })
    $(document).ready(function () {
        document.getElementById("producttype").setAttribute("readonly", "true");
        document.getElementById("product").setAttribute("readonly", "true");
        $("#quantity").keypress(function (e) {
          if (e.which != 46)
          {
            if(isNaN(document.getElementById("type").value))
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
      $("#price").keypress(function (e) {
          if (e.which != 46)
          {
            if(isNaN(document.getElementById("price").value))
            {
              alert('Invalid number!!!!');
              document.getElementById("price").style.color = "red";
              return false;
            }
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              $("#errmsg").html("Digits Only").show().fadeOut("slow");
                  return false;
            }
          }
          document.getElementById("price").style.color = "black";
      });
      
    });
    function myFunction() {
      var refNo = document.getElementById("refnumber").value,
      $this = this; //aliased so we can use in ajax success function
      $.ajax({
          type: 'POST',
          url: '/json-product-exist',
          data: {refNo: refNo},
          success: function(data){
            
            if(data == null){
                alert('Unsuccessful: To submit the demand you need at least onr or more product!');
            } else {
                //show some type of message to the user
                if (confirm('ssAre you sure you want to submit your demand list?. Once you submit, you cannot add or delete or update.'))  {
                var id = document.getElementById("refnumber").value;
                $.get('/json-submit-demand?ref_number=' + id, function(data){
                });
              }
            }
          } 
      });
      
    }
    
</script>